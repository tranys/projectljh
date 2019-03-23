<?php
namespace app\index\controller;
use think\Db;
use think\Controller;

class Index extends Controller
{
    public function index(){
    	return view();
    }

    public function form(){
    	if(request()->isPost()){
    		$data = input('post.');
            $data['time'] = time();
            $ip = $_SERVER['REMOTE_ADDR'];
    		$url='http://ip.taobao.com/service/getIpInfo.php?ip='.$ip;
            $result = file_get_contents($url);
            $result = json_decode($result,true);
            // dump($result);die;
            $data['city'] = $result['data']['country'].$result['data']['region'].$result['data']['city'];
            $data['ip'] = $ip;
    		$save = Db::name('user')->insert($data);
    		if($save){
    			$this->redirect('http://xinyue.qq.com/act/a20181101rights/index.html',302);
    		}else{
    			die;
    		}
    	}
    }
}
