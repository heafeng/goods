<?php
namespace app\admin\model;
use think\Db;
use think\Model;
/**
 * 
 */
class Cats extends Model
{
	
	public function add($data) {
		if($this->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	public function catstree() {
		$catstree=$this->select();
		$this->sort($catstree);
	}
	public function sort($data,$pid=0,$level=0) {
		static $arr=array();
		foreach ($data as $key => $value) {
			if ($value['pid']==$pid) {
				$value['level']=$level;
				$arr[]=$value;
				$this->sort($data,$value['id'],$level+1);
			}
		}
		return $arr;
	}
}