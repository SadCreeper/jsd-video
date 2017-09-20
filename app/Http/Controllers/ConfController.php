<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Conf;

class ConfController extends Controller
{
    //更新配置
    public function update(Request $request)
    {
        //验证数据
        $this->validate($request, [
            'key' => 'required',
        ]);

        //取数据
        $conf = Conf::where('key',$request->key)->first();
        $conf->update([
            'value' => $request->value,
        ]);

        return response()->json([
            'status' => 200,
            'message' => '更新成功'
        ]);
    }
}
