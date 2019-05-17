<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Goods as GoodsModel;
use think\Db;
use think\Session;
use FileName\FileName;
use app\admin\model\Attr;
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
				$this->success('添加成功','goods/goodsList');
			}else{
				$this->error('添加失败');
			}
    	// echo json_encode($result);die;
	}
    public function addAttr() {
        // $this->assign('goods_id',$id);
        return $this->fetch();
    }
    public function doAddAttr() {
        $data=input('get.');
        var_dump($data);die;
        $data=input('post.');
        $result=[
            'color'     => $data['color'],
        ];
    }
	public function lists() {
		$goods=new GoodsModel();
        $goodsres=$goods->getGoods();
        $this->assign('goodsres',$goodsres);
        return $this->fetch();
	}
    public function attr($id) {
        $attr=new GoodsModel();
        $attrres=$attr->getAttrById($id);
        // if (empty($attrres)) {
        //     $attrres[]=[
        //         'id'      =>'',
        //         'backimg' =>'',
        //         'color'   =>'',
        //         'goods_id'=>$id,
        //     ];
        // }
        $this->assign('goodsid',$id);
        $this->assign('attrres',$attrres);
        return $this->fetch();
    }
}