<?php
namespace app\backstage\model;
use think\Model;

class User extends Model
{
    public function login($data){
        $uname = $data['uname'];
        $password = md5($data['password']);
        $admins = User::get(['uname'=>$uname]);
        if($admins){
            $_password = $admins['password'];
            if($password == $_password){
                if($admins['status'] == 0){
                    return 4;//账户禁用
                }
                session('uname',$uname);
                session('id',$admins['id']);
                return 1;//密码正确，可以登陆
            }else{
                return 2;//密码错误，不能登录
            }
        }else{
            return 3;//用户不存在
        }
    }
}
