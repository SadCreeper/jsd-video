//生命变量
accessid = ''        //access ID
accesskey = ''       //access key
host = ''            //链接
policyBase64 = ''    //权限码
signature = ''       //签名
filename = ''        //文件名
key = ''             //文件目录
expire = 0           //
now = timestamp = Date.parse(new Date()) / 1000; //获取当前时间戳

//发送HTTP请求
function send_request()
{
    var xmlhttp = null;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (xmlhttp!=null)
    {
        //phpUrl = 'http://10.101.166.2/php/get.php'
        phpUrl = '/upload'
        xmlhttp.open( "GET", phpUrl, false );
        xmlhttp.send( null );
        return xmlhttp.responseText
    }
    else
    {
        alert("Your browser does not support XMLHTTP.");
    }
};

//获取签名
function get_signature()
{
    //可以判断当前expire是否超过了当前时间,如果超过了当前时间,就重新取一下.3s 做为缓冲
    now = timestamp = Date.parse(new Date()) / 1000;
    //console.log('get_signature ...');
    //console.log('expire:' + expire.toString());
    //console.log('now:', + now.toString())
    if (expire < now + 3)
    {
        //console.log('get new sign')
        body = send_request()
        var obj = eval ("(" + body + ")");
        host = obj['host']
        policyBase64 = obj['policy']
        accessid = obj['accessid']
        signature = obj['signature']
        expire = parseInt(obj['expire'])
        key = obj['dir']
        return true;
    }
    return false;
};

//生成随机字符串
function random_string(len) {
　　len = len || 32;
　　var chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
　　var maxPos = chars.length;
　　var pwd = '';
　　for (i = 0; i < len; i++) {
    　　pwd += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}

//获取后缀
function get_suffix(filename) {
    pos = filename.lastIndexOf('.')
    suffix = ''
    if (pos != -1) {
        suffix = filename.substring(pos)
    }
    return suffix;
}

//生成文件名
function calculate_object_name(filename)
{
    var mydate = new Date();
    suffix = get_suffix(filename)
    g_object_name = key + mydate.toLocaleDateString() + random_string(10) + suffix
    return ''
}

//设置上传参数
function set_upload_param(up, filename)
{
    var ret = get_signature()
    if (ret == true)
    {
        calculate_object_name(filename)
        $("input#video").val(g_object_name)
        new_multipart_params = {
            'key' : g_object_name,
            'policy': policyBase64,
            'OSSAccessKeyId': accessid,
            'success_action_status' : '200', //让服务端返回200,不然，默认会返回204
            'signature': signature,
        };

        up.setOption({
            'url': host,
            'multipart_params': new_multipart_params
        });

        //console.log('reset uploader')
        //uploader.start();
    }
}

//uploader 实例
var uploader = new plupload.Uploader({
	runtimes : 'html5,flash,silverlight,html4',
	browse_button : 'selectfiles',
	container: document.getElementById('container'),
	flash_swf_url : '/js/upload/plupload/Moxie.swf',
	silverlight_xap_url : '/js/upload/plupload/Moxie.xap',
    url : 'http://oss.aliyuncs.com',
    multi_selection : false, //是否允许多传

    filters: {
        mime_types : [ //只允许上传mp4
        { title : "Video files", extensions : "mp4" },
        ],
        max_file_size : '500mb', //最大只能上传10mb的文件
    },

	init: {

        //当Init事件发生后触发
		PostInit: function() {
			document.getElementById('ossfile').innerHTML = '';
		},

        //当文件添加到上传队列后触发
		FilesAdded: function(up, files) {
            if (uploader.files.length > 1) {
                alert("只能上传一个视频");
                uploader.removeFile(files[0]);
                return ''
            }
			document.getElementById('ossfile').innerHTML += '<div id="' + files[0].id + '">' + files[0].name + ' (' + plupload.formatSize(files[0].size) + ')<b></b>'
			+'<div class="progress"><div class="progress-bar" style="width: 0%"></div></div>'
			+'</div>';
            set_upload_param(up, files[0].name);
            uploader.start();
		},

        //会在文件上传过程中不断触发，可以用此事件来显示上传进度
		UploadProgress: function(up, file) {
			var d = document.getElementById(file.id);
			d.getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";

            var prog = d.getElementsByTagName('div')[0];
			var progBar = prog.getElementsByTagName('div')[0]
			progBar.style.width= 2*file.percent+'px';
			progBar.setAttribute('aria-valuenow', file.percent);
		},

        //当队列中的某一个文件上传完成后触发
		FileUploaded: function(up, file, info) {
            console.log('上传完成x1')
            console.log(info.status)
            $("#videoFormBtn").removeAttr("disabled");
            //set_upload_param(up, file.name);
            if (info.status >= 200 || info.status < 200)
            {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = ' 上传成功';
            }
            else
            {
                document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
            }
		},

        //当发生错误时触发
		Error: function(up, err) {
			document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
		}
	}
});

uploader.init();
