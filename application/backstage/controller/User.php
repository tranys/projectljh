<?php
namespace app\backstage\controller;
use think\Db;

class User extends Common
{
    public function lst(){
        $nums = Db::name('user')->count();
        $prefix = config('database.prefix');
        $authGroupName = $prefix.'auth_group';
        $adminRes = Db::name('user')->alias('a')->field('a.*,g.title as groupname')->join('auth_group g','a.groupid = g.id')->order('id asc')->select();
        $this->assign([
            'nums' => $nums,
            'adminRes' => $adminRes,
        ]);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $data['create_time'] = time();
            $data['password'] = md5($data['password']);
            unset($data['repass']);
            $add = Db::name('user')->insertGetId($data);
            $_data = array();//对应管理员和用户组
            $_data['uid']=$add;
            $_data['group_id']=$data['groupid'];
            $addGroupAccess = Db::name('auth_group_access')->insert($_data);
            if($add&&$addGroupAccess){
                return 1;
            }else{
                return 2;
            }
        }
        //所属用户组
        $groupRes = db('auth_group')->select();
        $this->assign([
            'groupRes' => $groupRes,
        ]);
        return view();
    }

    public function edit($id){
        $users = Db::name('user')->where('id',$id)->find();
        $password = $users['password'];
        if(request()->isPost()){
            $data = input('post.');
            if($data['password']){
                $data['password'] = md5($data['password']);
            }else{
                $data['password'] = $password;
            }
            $save = Db::name('user')->where('id',$id)->update($data);
            Db::name('auth_group_access')->where(array('uid'=>$data['id']))->update(['group_id'=>$data['groupid']]);
            if($save!==false){
                return 1;
            }else{
                return 2;
            }
        }
        //所属用户组
        $groupRes = db('auth_group')->select();
        $this->assign([
            'users' => $users,
            'groupRes' => $groupRes,
        ]);
        return view();
    }

    public function del($id){
        if($id==1){
            return 0;
        }else{
            $del = Db::name('user')->where('id',$id)->delete();
            if($del){
                return 1;
            }else{
                return 2;
            }
        }
        
    }

    public function changestatus($id){
        $_status = Db::name('user')->where('id',$id)->find();
        $status = $_status['status'];
        if($id==1){
            return 0;
        }else{
            if($status == 1){
                Db::name('user')->where('id',$id)->setField('status',0);
                return 1;
            }else{
                Db::name('user')->where('id',$id)->setField('status',1);
                return 2;
            }
        }
    }

}
