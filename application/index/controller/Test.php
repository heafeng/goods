<?php
namespace app\index\controller;
use think\Ctroller;
use \app\index\model\Test as TestModel;
use \cache\Cache;
/**
 * 
 */
class Test
{
	public function test(){
		// $redis=new \redis();
		// $redis->connect('192.168.199.249','6379');
		// $redis->set('cat', 222);
		// $name=$redis->get('cat');
		// dump($name);die;
		$redis=new Cache();
		$redis->setCache('cat','19');
		$name=$redis->getCache('cat');
		dump($name);die;
	} 
}