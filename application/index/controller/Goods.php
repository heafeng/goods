<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Banner;
use app\index\model\Tag;
use app\index\model\Goods as GoodsModel;
use app\index\model\Token;
use app\index\model\Cart;
use filename\Response;
class Goods extends Banner
{
    public function getList()
    {
        // phpinfo();die;
    	$goodsLists   = new GoodsModel();
    	$bannerLists  = new Banner();
    	$tagLists     = new Tag();
    	$arra     = $tagLists->getInfo();
    	// var_dump($arra);die;

    	$arr      = $goodsLists->getInfo();
    	$goodsRes = $goodsLists->formatGoods($arr,$arra);

    	$ar     = $bannerLists->getInfo();
    	$bannerRes=$bannerLists->formatBanner($ar);
        // $result = [
        //     'error'=>0,
        //     'msg'=>'ok',
        //     'data'=>[
        //         'goods'=>$goodsRes,
        //         'banner'=>$bannerRes,
        //     ]
        //     ];
        // return json_encode($result);die;
    	$result = [
    			'goods'=>$goodsRes,
    			'banner'=>$bannerRes,
    		];
    	// FileName::Response()->returnData($result);
        $data=Response::returnData($result);
        return $data;die;
    }
    public function detail() {
        $id=input('get.id');
        if(empty($id)){
           $result = [
            'error'=> 1,
            'msg'  => 'param error',
            'data' =>[],
            ]; 
            echo json_encode($result);
            die();
        }
        $tagLists     = new Tag();
        $goodsLists   = new GoodsModel();
        $arra     = $tagLists->getInfo();
        $arr      = $goodsLists->getList($id);
        $goodsRes = $goodsLists->formatDetail($arr,$arra);
        $result = [
            'error'=>0,
            'msg'=>'ok',
            'data'=>[
                'info'=>$goodsRes,
            ],
            ];
        return json_encode($result);die;
    }
    public function cart(){
        $data  = input('post.');
        $id    = input('post.id');
        $token = input('post.token');
        $tokenLists = new token();
        $cartLists  = new cart();
        $goodsLists = new GoodsModel();
        $tokenRes   = $tokenLists->getUserToken($token);
        if (!empty($id)) {
             $info = $goodsLists->getGooodsInfo($id);
            $data= [
                'goods_name' => $info['name'],
                'count'      => $data['count'],
                'color'      => $data['color'],
                'price'      => $info['price'],
                'user_id'    => $tokenRes['id'],
                'size'       => $data['size'],
                ];
            $carts    = $cartLists->addCart($data);
            $result = [
            'error'=> 0,
            'msg'  => '已加入购物车',
            'data' =>[],
            ];
        }else{
           $result = [
            'error'=> 1,
            'msg'  => 'param error',
            'data' =>[],
            ]; 
        }  
        echo json_encode($result);die(); 
    }
    public function cartInfo() {
        $token = input('post.token');
        $cartLists  = new cart();
        $tokenLists = new token();
        $tokenRes   = $tokenLists->getUserToken($token);
        if(!empty($tokenRes['id'])){
            $cartInfo = $cartLists->getCartInfo($tokenRes['id']);
            $cartRes = $cartLists->formatCart($cartInfo);
            $result = [
                'error'=>0,
                'msg'=>'ok',
                'data'=>[
                    'cart'=>$cartRes,
                ]
                ];
            return json_encode($result);die;
        }else{
           $result = [
            'error'=> 1,
            'msg'  => 'param error',
            'data' =>[],
            ]; 
            echo json_encode($result);
            die();
        } 
    }
}
