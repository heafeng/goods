<?php
namespace app\index\model;
use think\Model;
/**
 * 
 */
class Cart extends Model
{
	public function addCart($data) {
		return $this->save($data);
	}
	public function getCartInfo($id){
	$data=$this->where('user_id',$id)->select();
	$data = collection($data)->toArray();
	return $data;
	}
	public function formatCart($data){
		$result=[];
		foreach ($data as $value) {
			$result[]= [
			'id'     => $value['id'],
    		'name'   => $value['goods_name'],
    		'attr_img'=> $value['attr_img'],
    		'count'  => $value['count'],
    		'color'  => $value['color'],
    		'price'  => "￥".$value['price']/100,
    		'size'   => $value['size'],   
    		];
		}
		return $result;
	}
	public function delCart($id){
		$info=$this->destroy($id);
		return $info;
	}
}