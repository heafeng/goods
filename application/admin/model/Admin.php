<?php
namespace app\admin\model;
use think\Db;
use think\Model;
class Admin extends Model
{
	
	public function addadmin($data) {
		if(empty($data)||!is_array($data)) {
			
			return false;
		}
		if($this->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	public function getadmin() {
		return $this::paginate(5);
	}
	public function updateAdmin($id,$data) {
		$info=$this->save($data,['id'=>$id]);
		return $info;
	}
	public function delAdmin($id) {
		$info=$this->destroy($id);
		return $info;
	}
	public function login($data) {
		$phone=$this->getByPhone($data['phone']);
		// var_dump($name);die;
		if($phone){
			if($phone['password']=$data['password']) {
				return 2;
			}else{
				return 3;
			}
		}else{
			return 1;
		}

	}
}