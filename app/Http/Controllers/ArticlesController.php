<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;
use Auth;
use Storage;
use DateTime;
use OSS\OssClient;
use Image;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['index', 'manage', 'create', 'store', 'upload', 'uploadPhotos', 'praised']
        ]);
    }
    //点赞
    public function praise($article_id)
    {
        $user = Auth::user();
        if ($user) {
            if (count($user->articles_praise()->where('article_id', $article_id)->get())) {
                $user->articles_praise()->detach($article_id);
                return response()->json([
                    'status' => 10001,
                    'message' => '取消成功'
                ]);
            }else {
                $user->articles_praise()->attach($article_id);
                return response()->json([
                    'status' => 200,
                    'message' => '点赞成功'
                ]);
            }
        }else {
            return response()->json([
                'status' => 10002,
                'message' => '未登录'
            ]);
        }
    }
    //我赞过的文章
    public function praised()
    {
        $user = Auth::user();
        $articles = $user->articles_praise()->paginate(20);
        return view('articles.praised', compact('articles'));
    }
    //上传（网页向后端请求签名后直传OSS）
    public function upload()
    {
        $id= 'LTAIzh8m2hZTsDVU';
        $key= 'QDeZGRKNo0emC7tNVXtLXDlTEAavV0';
        $host = 'http://z970-images.oss-cn-shanghai.aliyuncs.com';
        $now = time();
        $expire = 30; //设置该policy超时时间是10s. 即这个policy过了这个有效时间，将不能访问
        $end = $now + $expire;
        $expiration = $this->gmt_iso8601($end);

        //$oss_sdk_service = new alioss($id, $key, $host);
        $dir = '';

        //最大文件大小.用户可以自己设置
        $condition = array(0=>'content-length-range', 1=>0, 2=>1048576000);
        $conditions[] = $condition;

        //表示用户上传的数据,必须是以$dir开始, 不然上传会失败,这一步不是必须项,只是为了安全起见,防止用户通过policy上传到别人的目录
        $start = array(0=>'starts-with', 1=>'$key', 2=>$dir);
        $conditions[] = $start;


        //这里默认设置是２０２０年.注意了,可以根据自己的逻辑,设定expire 时间.达到让前端定时到后面取signature的逻辑
        $arr = array('expiration'=>$expiration,'conditions'=>$conditions);
        //echo json_encode($arr);
        //return;
        $policy = json_encode($arr);
        $base64_policy = base64_encode($policy);
        $string_to_sign = $base64_policy;
        $signature = base64_encode(hash_hmac('sha1', $string_to_sign, $key, true));

        $response = array();
        $response['accessid'] = $id;
        $response['host'] = $host;
        $response['policy'] = $base64_policy;
        $response['signature'] = $signature;
        $response['expire'] = $end;
        //这个参数是设置用户上传指定的前缀
        $response['dir'] = $dir;
        echo json_encode($response);
    }
    function gmt_iso8601($time) {
        $dtStr = date("c", $time);
        $mydatetime = new DateTime($dtStr);
        $expiration = $mydatetime->format(DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration."Z";
    }

    //上传相片
    public function uploadPhotos(Request $request)
    {
        $name = time(). '_' .$_FILES['file']['name'];
        try {
            $ossClient = new OssClient("LTAIzh8m2hZTsDVU", "QDeZGRKNo0emC7tNVXtLXDlTEAavV0", "http://oss-cn-shanghai.aliyuncs.com");
            $ossClient->putObject("z970-video", $name, file_get_contents($_FILES['file']['tmp_name']));
            //var_dump($name);
            return response()->json([
                'status' => 200,
                'message' => '上传成功！',
                'name' => $name
            ]);
        } catch (OssException $e) {
            //var_dump($e->getMessage()) ;
        }

        // $path = $request->file->store('public/images/photos','local');
        // $path = '/'.str_replace("public","storage",$path);
        // $name = ltrim($path,"/storage/images/photos/");
        // try {
        //     $ossClient = new OssClient("LTAIzh8m2hZTsDVU", "QDeZGRKNo0emC7tNVXtLXDlTEAavV0", "http://oss-cn-shanghai.aliyuncs.com");
        //     $ossClient->putObject("z970-video", $name, file_get_contents("/storage/images/photos/e1c93cceb5a192710d32bce965fdec05.jpeg"));
        // } catch (OssException $e) {
        //     var_dump($e->getMessage()) ;
        // }
    }


    //文章搜索页
    public function search(Request $request)
    {
        $articles = Article::where('title', 'like', '%'.$request->key.'%')->paginate(20);
        return view('articles.search', compact('articles'));
    }
    //文章分类页
    public function category($id)
    {
        //获取分类下全部文章
        $articles = Article::filterArticlesByCategory($id);
        //获取分类下最热文章
        $articles_hot = Article::filterArticlesSmartHot('view', 9, $id);
        return view('articles.category', compact('articles', 'articles_hot'));
    }
    //文章管理页
    public function manage()
    {
        //验证登录用户是否为管理员
        $this->authorize('admin', Auth::user());
        $articles = Article::paginate(20);
        return view('articles.manage', compact('articles'));
    }
    //我的上传
    public function index()
    {
        $user_id = Auth::id();
        $articles = Article::where('user_id', $user_id)->orderBy('created_at', 'desc')->paginate(20);
        return view('articles.index', compact('articles'));
    }
    //展示页
    public function show($id)
    {
        //更新浏览量
        Article::update_view($id);

        $article = Article::findOrFail($id);
        if ($article->type == 1) {
            return view('articles.show_video', compact('article'));
        }
        if ($article->type == 2) {
            $photos_str = $article->photos;
            $photos_arr = explode(',',$photos_str);
            return view('articles.show_album', compact('article','photos_arr'));
        }

    }
    //上传页
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }
    //上传
    public function store(Request $request)
    {
        //验证数据
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:50',
            'cover' => 'required',
        ]);

        //保存封面图片并生成路径
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                //封面图片压缩存储并生成路径
                $path = "img/covers/" . time() . "_" . str_random(10) . ".jpg";
                Image::make($request->cover)->resize(480, 300)->save(public_path($path));
                $path = '/'.$path;
                //$path = $request->cover->store('public/images/covers','local');
                //$path = '/'.str_replace("public","storage",$path);
            }
        }

        //保存文章数据
        if ($request->has('video')) {
            $type = 1;
            $article = Article::create([
                'user_id' => Auth::id(),
                'type' => $type,
                'title' => $request->title,
                'category_id' => $request->category,
                'cover' => $path,
                'intro' => $request->intro,
                'video' => $request->video,
            ]);
            return response()->json([
                'status' => 200,
                'message' => '保存成功！'
            ]);
        }else if ($request->has('photos')) {
            $type = 2;
            $article = Article::create([
                'user_id' => Auth::id(),
                'type' => $type,
                'title' => $request->title,
                'category_id' => $request->category,
                'cover' => $path,
                'intro' => $request->intro,
                'photos' => $request->photos,
            ]);
            session()->flash('success', '上传成功！');
            return redirect('articles');
        }else{
            session()->flash('danger', '请上传图片或视频');
            return back();
            // return response()->json([
            //     'status' => 10001,
            //     'message' => '请上传视频！'
            // ]);
        }

        //session()->flash('success', '上传成功！');
        //return back();
    }
    //编辑
    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        return view('articles.edit', compact('categories', 'article'));
    }

    public function update(Request $request, $id)
    {
        //验证数据
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|max:50',
        ]);

        //取数据
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        //更新文章数据
        $data = [];
        $data['title'] = $request->title;
        $data['category_id'] = $request->category;
        $data['intro'] = $request->intro;
        if ($request->has('video')) {

        }
        if ($request->has('photo')) {

        }
        $article->update($data);

        session()->flash('success', '更新成功！');
        return back();
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);
        $article->delete();
        session()->flash('success', '删除成功！');
        return back();
    }
}
