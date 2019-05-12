<?php
namespace app\index\Model;
use think\Model;
/**
 * 
 */
class Goods extends Model
{	
	public function getInfo(){
	$data=$this->select();
	// $data = $data->toArray();
	return $data;
	}
	public function getGooodsInfo($id){
	$data=$this->where('id',$id)->find();
	$data = $data->toArray();
	return $data;
	}
	public function formatGoods($data,$tag=array()){
		// var_dump($data);die;
		$result=[];
		foreach ($data as $item) {
			$value=[
				'id'    => $item['id'],
				'title' => $item['name'],
				'img'   => $item['img'],
				'desc'  => $item['pro'],
				'price' => "￥".$item['price']/100,
				'tag'   => [],
			];

			$tagArr = explode(',', $item['tag_id']);
			// var_dump($item['tag_id']);die;
            foreach ($tagArr as $tagId) {
            	// var_dump($tag[$tagId]);die;
                $value['tag'][] = $tag[$tagId];
            }
			// // $value['tag_id'][]=$tag[];
			// $value['tag'][] = $tag[$item['tag_id']];
			$result[]=$value;
		}
		return $result;
	}
	public function getList($id) {
		return $this->where('id',$id)->find();
	}
	public function formatDetail($item,$tag=array()) {
		// var_dump($item);die;
		$result=[];
		$value=[
			'id'     => $item['id'],
			'title'  => $item['name'],
			'img'    => $item['img'],
			'desc'   => $item['pro'],
			'price'  => "￥".$item['price']/100,
			'tag'    => [],
			'content'=>htmlspecialchars_decode($item['content']),

		];
		$tagArr = explode(',', $item['tag_id']); //2,3 => [2,3]
		// var_dump();die;
        foreach ($tagArr as $tagId) {
            $value['tag'][] = $tag[$tagId];
        }
		// // $value['tag_id'][]=$tag[];
		// $value['tag'][] = $tag[$item['tag_id']];
		$result=$value;
		// var_dump($result);die;
		return $result;
	}
}