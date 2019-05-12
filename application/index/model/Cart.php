<?php
namespace app\index\model;
use think\Model;
/**
 * 
 */
class Cart extends Model
{
	public function addCart($data) {
		// protected $autoWriteTimestamp = true;
		// var_dump($data);die;
		// unset($data['create_time']);
		// unset($data['update_time']);
		return $this->save($data);
		// var_dump($data);die;
		// if($this->insert($data)) {
		// 	return true;
		// }else{
		// 	return false;
		// }
	}
	public function getCartInfo($id){
	$data=$this->where('user_id',$id)->select();
	// var_dump($data);die;
	// $data = $data->toArray();
	// var_dump($data);die;
	$data = collection($data)->toArray();
	return $data;
	}
	public function formatCart($data){
		$result=[];
		foreach ($data as $value) {
			$result[]= [
    		'name'   => $value['goods_name'],
    		'count'  => $value['count'],
    		'color'  => $value['color'],
    		'price'  => "￥".$value['price']/100,
    		'size'   => $value['size'],   
    		];
		}
		return $result;
	}
}