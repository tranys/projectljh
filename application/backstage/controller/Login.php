<?php
namespace app\backstage\controller;
use think\Controller;
use think\Db;

class Login extends Controller
{
    public function index(){
        if(session('uname')&&session('id')){
            $this->success("您已登陆，请勿重复登陆！",'backstage/index/index');
        }
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code'])){
                return 2;
            };
            $loginStatus = model('User')->login($data);
            if($loginStatus == 1){
                Db::name('user')->where('id',session('id'))->setField('last_time',time());
                return 3;
            }else if($loginStatus == 4){
                return 4;
            }else{
                return 5;
            }
            return;
        }
        return view();
    }
}
