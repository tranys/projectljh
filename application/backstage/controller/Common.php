<?php
namespace app\backstage\controller;
use think\Controller;
use auth\Auth;
use think\Db;

class Common extends Controller
{
	public $config;

    public function initialize(){
        if(!session('uname')){
            $this->error("请先登录系统！",'Login/index');
        }
        $module = request()->module();//获取当前模块
        $con = request()->controller();//获取当前控制器
        $action = request()->action();//获取当前方法
        $name = $module.'/'.$con.'/'.$action;//$name=> admin/Cate/lst
        $uname = session('uname');
        $userStatus = Db::name('user')->field('groupid')->where('uname',$uname)->find();
        $this->assign([
            'con'=>$con,
            'name'=>$name,
            'uname'=>$uname,
            'userStatus' => $userStatus['groupid'],
        ]);

        $auth = new Auth();
        if(!$auth->check($name,session('id'))){
            $this->error("您没有该操作权限！");
        }
    }
}
