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
		$data =$this->where('user_id',$id)->select();
		$data = collection($data)->toArray();
		return $data;
	}
	public function check($data,$info){
		$result=[];
		foreach ($data as $key => $value) {
            $result[$value['goods_name']]=$value;
        }
        if (isset($result[$info['goods_name']])) {
            if ($info['color'] == $result[$info['goods_name']]['color']) {
                return 1;die;
            } else {
                return 0;die;
            }
        }
	}
	public function checkCart($id,$num){
		$data=$this->where('id',$id)->setField('count', $num);
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