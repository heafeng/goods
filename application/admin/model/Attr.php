<?php
namespace app\admin\model;
use think\Db;
use think\Model;
/**
 * 
 */
class Attr extends Model
{
	
	public function aadattr($data) {
		// var_dump($data);die;
		if($this->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	public function getAttr($id) {
		$data=$this->where('goods_id',$id)->select();
		$info = collection($data)->toArray();
		return $info;
	}
	public function delAttr($id) {
		$info=$this->destroy($id);
		return $info;
	}
	public function updateAttr($id,$data) {
		// $info=$this->where('id',$id)->update($data);
		$info=$this->save($data,['id'=>$id]);
		return $info;
	}
}