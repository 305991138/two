<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\Request;


class User extends BaseController
{
    public function login(){
        $user_yzm = $this->request->param('user_yzm');
        if(!captcha_check($user_yzm)){
            return "验证失败";die();
        };
        if($this->request->isPost()){
            $user_name = $_POST['user_name'];
            $user_pwd = $_POST['user_pwd'];
            $name = Db::table('user')->where('user_name', $user_name)->find();
            if(empty($user_name)){
                return "用户名不存在或不正确";die();
            }
            if(md5($user_pwd) != $name['user_pwd']){
                return "密码不正确";die();
            }
            Session::set('user', $name);

        }
        return view();
    }

    public function index(){

    }

}
