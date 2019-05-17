<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Banner;
use app\index\model\Tag;
use app\index\model\Goods as GoodsModel;
use app\index\model\Token;
use app\index\model\Cart;
use app\index\model\Attr;
use filename\Response;
class Goods extends Banner
{
    public function getList()
    {
        $goodsLists   = new GoodsModel();
    	$bannerLists  = new Banner();
    	$tagLists     = new Tag();
    	$arra     = $tagLists->getInfo();

    	$arr      = $goodsLists->getInfo();
    	$goodsRes = $goodsLists->formatGoods($arr,$arra);

    	$ar     = $bannerLists->getInfo();
    	$bannerRes=$bannerLists->formatBanner($ar);
    	$result = [
    			'goods'=>$goodsRes,
    			'banner'=>$bannerRes,
    		];
        return Response::returnData($result);die;
    }
    public function detail() {
        $id=input('get.id');
        if(empty($id)){
            return Response::returnData([],1, 'param error');die;
        }
        $attrLists    = new Attr();
        $tagLists     = new Tag();
        $goodsLists   = new GoodsModel();
        $arra         = $tagLists->getInfo();
        $arr          = $goodsLists->getList($id);
        $attrInfo     = $attrLists->getAttrInfo($id);
        $attrRes      = $attrLists->formatAttr($attrInfo);
        $goodsRes     = $goodsLists->formatDetail($arr,$arra,$attrRes);
        $result = [
                'info'=>$goodsRes,
            ];
        return Response::returnData($result);die;
    }
    public function cart(){
        $data       = input('post.');
        $id         = input('post.id');
        $attr_id    = input('post.attr_id');
        $token      = input('post.token');
        if (empty($data)) {
        return Response::returnData([],1, '没有数据');die;
        }
        $tokenLists = new token();
        $cartLists  = new cart();
        $attrLists  = new Attr();
        $goodsLists = new GoodsModel();
        $attrInfo   = $attrLists->getInfoById($attr_id);
        $tokenRes   = $tokenLists->getUserToken($token);
        $cartInfo   = $cartLists->getCartInfo($tokenRes['id']);
        $info       = $goodsLists->getGoodsInfo($id);
        $data= [
                'attr_img'   => $attrInfo['backimg'],
                'goods_name' => $info['name'],
                'count'      => $data['count'],
                'color'      => $data['color'],
                'price'      => $info['price'],
                'user_id'    => $tokenRes['id'],
                'size'       => $data['size'],
                ];
        if (empty($cartInfo)) {
            echo "123";
            $carts    = $cartLists->addCart($data);
            return Response::returnData([],0, '已加入购物车');die;
        }
        $check = $cartLists->check($cartInfo,$data);
        if($check){
            foreach ($cartInfo as $key => $value) {
                if($data['goods_name']==$value['goods_name']&&$data['color']==$value['color']){
                    $num=$data['count']+$value['count'];
                    $date=$cartLists->checkCart($value['id'],$num);
                }
            }
            return Response::returnData([],0, '已加入购物车');die;
        }else{
            $carts    = $cartLists->addCart($data);
            return Response::returnData([],0, '已加入购物车');die;
        }
        // $data = [
        //     'attr_img'   => $attrInfo['backimg'],
        //     'goods_name' => $info['name'],
        //     'count'      => $data['count'],
        //     'color'      => $data['color'],
        //     'price'      => $info['price'],
        //     'user_id'    => $tokenRes['id'],
        //     'size'       => $data['size'],
        //     ];
        // $carts    = $cartLists->addCart($data);
        // return Response::returnData([],0, '已加入购物车');die;
        // if (!empty($cartInfo)) {
        //     foreach ($cartInfo as $key => $value) {
        //         if($data['goods_name']==$value['goods_name']&&$data['color']==$value['color']){
        //             $num=$data['count']+$value['count'];
        //             $date=$cartLists->checkCart($value['id'],$num);
        //             if (!empty($date)) {
        //             return Response::returnData([],0, '已加入购物车');die;
        //             }
        //         }
        //     }
        // }else{
        //     $carts    = $cartLists->addCart($data);
        //     return Response::returnData([],0, '已加入购物车');die;
        // }
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
                    'cart'=>$cartRes,
                ];
            return Response::returnData($result);die;
        }else{
            return Response::returnData([],1, 'param error');die; 
        } 
    }
    public function deleteCart(){
        $id = input('post.id');
        $cartLists  = new cart();
        $cartRes    = $cartLists->delCart($id);
        if($cartRes){
            return Response::returnData([],0, '删除成功');die; 
        }else{
            return Response::returnData([],1, '删除失败');die;
        }
    }
    public function test()
    {
        $dbh= new PDO('127.0.0.1','root','','shop');
        $count = $dbh->exec("SELECT * FROM banner");
        echo $count;
    }
}
