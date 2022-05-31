<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Session;
class LoginController extends Controller
{
    public function index(){
        return view('admin/login');
    }
    public function login(Request $request)
{
    $username = $request->input('username', '');
    $password = $request->input('password', '');
    $input=$request->all();
    $rule=[
        'username'=>'required',
        'password'=>'required',
        'captcha' => 'required|captcha'
    ];
    $message=[
        'username.required'=>'用户名不能为空',
        'password.required'=>'密码不能为空',
        'captcha.captcha' => '验证码有误'
    ];
    $validator = Validator::make($input, $rule, $message);
    if ($validator->fails()) {
        $msg = '验证失败：';
        foreach ($validator->getMessageBag()->toArray() as $v) {
            $msg .= $v[0].';';
        }
        return response()->json(['code' => 0, 'msg' => $msg]);
    }        

    //使用DB类实现数据库交互
	$data=DB::table('cms_user')->where(['username'=>$username])->first();
    header('Content-Type:application/json');
    if(is_null($data)){
        return response()->json(['code'=>0,'msg'=>'用户不存在']);
    } 
    if($data->password!=$this->passwordMD5($password,$data->salt)){
        return response()->json(['code'=>0,'msg'=>'用户名或密码不正确']);
    }
    $this->setLogin(['id'=>$data->id,'name'=>$data->username]);
    return response()->json(['code'=>1,'msg'=>'登录成功']);
}

protected function passwordMD5($password, $salt)
{
    return md5(md5($password) . $salt);
}


    protected function setLogin(array $user=[]){  
        Session::put('user',$user);
    }

    public function logout(){
        if(Session::has('user')){
            Session::forget('user');
        }
        return redirect('/admin/login/index');
      
    }
}
