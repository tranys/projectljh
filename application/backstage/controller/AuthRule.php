<?php
namespace app\backstage\controller;
use think\Db;

class AuthRule extends Common
{
    public function lst(){
        $nums = Db::name('auth_rule')->count();
        $_authRules = Db::name('auth_rule')->order('id ASC')->select();
        $authRules = model('auth_rule')->ruletree($_authRules);
        $this->assign([
            'nums' => $nums,
            'authRules' => $authRules,
        ]);
        return view();
    }

    public function add($pid=0){
        if(request()->isPost()){
            $data = input('post.');
            $add = Db::name('auth_rule')->insert($data);
            if($add){
                return 1;
            }else{
                return 2;
            }
        }
        $ruleRes = Db::name('auth_rule')->select();
        $ruleTree = model('auth_rule')->ruletree($ruleRes);
        $this->assign([
            'ruleTree' => $ruleTree,
            'pid' => $pid,
        ]);
        return view();
    }

    public function edit($id){
        if(request()->isPost()){
            $data = input('post.');
            $save = Db::name('auth_rule')->update($data);
            if($save!==false){
                return 1;
            }else{
                return 2;
            }
            return;
        }
        $rules = Db::name('auth_rule')->find($id);
        $ruleRes = Db::name('auth_rule')->select();
        $ruleTree = model('auth_rule')->ruletree($ruleRes);
        $this->assign([
            'ruleTree' => $ruleTree,
            'rules' => $rules,
        ]);
        return view();
    }

    public function del($id){
        $cid = model('AuthRule')->childrenids($id);
        $cid[] = $id;
        $del = Db::name('auth_rule')->delete($cid);
        if($del){
            return 1;
        }else{
            return 2;
        }
    }
}
