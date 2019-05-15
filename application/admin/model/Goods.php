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
	public function getGoods() {
		return $this->paginate(5);
	}
	public function delGoods($id) {
		$info=$this->destroy($id);
		return $info;
	}
	public function updateGoods($id,$data) {
		// $info=$this->where('id',$id)->update($data);
		$info=$this->save($data,['id'=>$id]);
		return $info;
	}
	public function getAttrById($id){
	$attr = Db::name('attr')->where('goods_id',$id)->select();
	// var_dump($attr);die;
	// $data=$this->where('goods_id',$id)->select();
	// $data = collection($data)->toArray();
	// var_dump($data);die;
	return $attr;
	}
}