<?php
namespace app\index\Model;
use think\Model;
/**
 * 
 */
class Tag extends Model
{	
	public function getInfo(){
		$info=$this->select();
		$res=[];
		foreach ($info as $key => $value) {
			$res[$value['id']]=$this->formatTag($value);
		}
		return $res;
	}
	public function formatTag($item){
			$result=[
				'name'  => $item['name'],
				'color' => $item['color'],
			];
		return $result;
	}
	public function formatItem($list) {
		$result=[];
		foreach ($list as $key => $value) {
			$result=$this->formatTag($value);
		}
		return $result;
	}
}