<?php
namespace app\index\Model;
use think\Model;
/**
 * 
 */
class Banner extends Model
{	
	public function getInfo(){
	return $this->select();
	}
	public function formatBanner($data){
		$result=[];
		foreach ($data as $value) {
			$result[]= [
    		'url'=>$value['url'],
    		'img'=>$value['img'],
    		];
		}
		return $result;
	}
}