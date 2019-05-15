<?php
namespace app\index\model;
use think\Model;
/**
 * 
 */
class Attr extends Model
{
	public function getAttrInfo($id){
	$data=$this->where('goods_id',$id)->select();
	$data = collection($data)->toArray();
	return $data;
	}

	public function getInfoById($id){
	$data=$this->where('id',$id)->find();
	$data = $data->toArray();
	return $data;
	}

	public function formatAttr($data){
		$result=[];
		foreach ($data as $value) {
			$result[]= [
    		'id'   => $value['id'],
    		'backimg'  => $value['backimg'],
    		'color'  => $value['color'],   
    		];
		}
		return $result;
	}
}