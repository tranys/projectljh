<?php
namespace app\backstage\controller;
use think\Controller;
use think\Db;

class Index extends Common
{
	public function welcome(){
		$host = $_SERVER['HTTP_HOST'];
    	$environment = php_sapi_name();
    	$os = PHP_OS;
    	$version = PHP_VERSION;
    	if(@ini_get('file_uploads')){
	      $file_uploads = ini_get('upload_max_filesize');
	   	}
	   	$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	   	$port = $_SERVER['SERVER_PORT'];
	   	$database = config("database.database");
	   	$time = date("Y-m-d H:i:s", time());
    	$ip = $_SERVER['REMOTE_ADDR'];
    	$this->assign([
    		'host' => $host,
    		'os' => $os,
    		'environment' => $environment,
    		'version' => $version,
    		'file_uploads' => $file_uploads,
    		'language' => $language,
    		'port' => $port,
    		'database' => $database,
    		'time' => $time,
    		'ip' => $ip,
    	]);
    	return view();
    }

    public function index(){
    	return view();
    }
}
