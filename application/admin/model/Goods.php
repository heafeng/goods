<?php
namespace app\admin\model;
use think\Db;
use think\Model;
/**
 * 
 */
class Goods extends Model
{
	
	public function aadGoods($data) {
		// var_dump($data);die;
		if($this->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	public function getwords() {
		return $this::paginate(5);
	}
	public function delWords($id) {
		$info=$this->destroy($id);
		return $info;
	}
	public function updateWords($id,$data) {
		// $info=$this->where('id',$id)->update($data);
		$info=$this->save($data,['id'=>$id]);
		return $info;
	}
}