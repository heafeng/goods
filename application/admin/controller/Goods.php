<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Goods as GoodsModel;
use think\Db;
use think\Session;
use FileName\FileName;
/**
 * 
 */
class Goods extends Controller
{
	
	public function add() {
		return $this->fetch();
	}
	public function doAdd(){
		$data=input('post.');
		// var_dump($data);die;
		$result=[
			'name'    => $data['name'],
			'pro'     => $data['pro'],
			'price'   => $data['price']*100,
			'content' => $data['content'],
			'tag_id'  => $data['tag_id'],
		];
		// var_dump($result['content']);die;
		// $file=FileName::getIntance()->upload('img');
		$file=FileName::upload('img');
    	$result['img']=$file;
    	// var_dump($result);die;
    	$goodsList=new GoodsModel();
    	$goodsRes=$goodsList->aadGoods($result);
    	if(!$goodsRes==false){
				$this->success('添加成功');
			}else{
				$this->error('添加失败');
			}
    	// echo json_encode($result);die;
	}
	public function login() {
		$data=input('post.');
		$result=[
			'phone'    => $data['phone'],
			'password'     => $data['password'],
		];	
	}
}