<?php
namespace app\index\model;
use think\Model;
/**
 * 
 */
class Cart extends Model
{
	public function addCart($data){
		return $this->save($data);
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