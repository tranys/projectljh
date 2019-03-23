<?php
namespace app\backstage\controller;

class Logout extends Common
{
    public function logout(){
        session(null);//清空session
        $this->success("退出成功",'login/index');
    }
}
