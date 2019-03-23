<?php
namespace app\backstage\controller;
use think\Db;

class AuthGroup extends Common
{
    public function lst(){
        $nums = Db::name('auth_group')->count();
        $authGroupRes = Db::name('auth_group')->select();
        $this->assign([
            'nums' => $nums,
            'authGroupRes' => $authGroupRes,
        ]);
        return view();
    }

    public function add(){
        if(request()->isPost()){
            $data = input('post.');
            $add = Db::name('auth_group')->insert($data);
            if($add){
                return 1;
            }else{
                return 2;
            }
        }
        return view();
    }

    public function edit($id){
        if(request()->isPost()){
            $data = input('post.');
            $save = Db::name('auth_group')->update($data);
            if($save!==false){
                $this->success("用户组修改成功！",'lst');
            }else{
                $this->error("用户组修改失败！");
            }
            return;
        }
        $authGroups = Db::name('auth_group')->find($id);
        $this->assign([
            'authGroups' => $authGroups,
        ]);
        return view();
    }

    public function changestatus($id){
        $_status = Db::name('auth_group')->where('id',$id)->find();
        $status = $_status['status'];
        if($id==1){
            return 0;
        }else{
            if($status == 1){
                Db::name('auth_group')->where('id',$id)->setField('status',0);
                return 1;
            }else{
                Db::name('auth_group')->where('id',$id)->setField('status',1);
                return 2;
            }
        }
    }

    public function del($id){
        if($id==1){
            return 0;
        }else{
            $delAdmin = Db::name('user')->where(array('groupid'=>$id))->delete();//删除用户组前先删除用户组下的管理员
            $del = Db::name('auth_group')->delete($id);
            if($del && $delAdmin){
                return 1;
            }else{
                return 2;
            }
        }
    }

    //用户组权限控制
    public function key($id){
        if(request()->isPost()){
            $data = input('post.');
            if($data['rules']){
                $rules = implode(',', $data['rules']);
            }
            $save = Db::name('auth_group')->where(array('id'=>$data['id']))->update(['rules'=>$rules]);
            if($save!==false){
                return 1;
            }else{
                return 2;
            }
            return;
        }
        $data = Db::name('auth_rule')->where(['pid'=>0])->select();//一级规则
        foreach ($data as $k => $v) {
            $data[$k]['children'] = Db::name('auth_rule')->where(['pid'=>$v['id']])->select();//二级规则
            foreach ($data[$k]['children'] as $k1 => $v1) {
                $data[$k]['children'][$k1]['children'] = Db::name('auth_rule')->where(['pid'=>$v1['id']])->select();//三级规则
            }
        }
        $authGroups = Db::name('auth_group')->find($id);
        $rules = explode(',', $authGroups['rules']);
        $this->assign([
            'authGroups' => $authGroups,
            'data' => $data,
            'rules' => $rules,
        ]);
        return view();
    }
}
