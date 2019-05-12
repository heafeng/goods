<?php
namespace app\index\model;
use think\Db;
use think\Model;
use Cache\Cache;
/**
 * 
 */
class Token extends Model
{
	public $table ='token';
	public function setUserToken($userInfo){
		$time=md5(time().rand(1,10000));
		$user=md5(serialize($userInfo));
		$token='usesr_token'.md5($time.$user);
		$data=[
			'token'=>$token,
			'value'=>serialize($userInfo),
		];
		// var_dump($data);die;
		if($this->insert($data)) {
			return $token;die;
		}else{
			return false;
		}
	}
	public function getUserToken($info){
		$data = $this->where('token',$info)->find();
		$data = $data->toArray();
		return unserialize($data['value']);
	}
}