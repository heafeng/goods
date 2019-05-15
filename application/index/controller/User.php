<?php

namespace app\index\controller;
use think\Controller;
use app\index\model\User as UserModel;
use FileName\FileName;
use userConter\UserConter;
use app\index\model\Token;
use filename\Response;
/**
 * 
 */
class User 
{
	public function getUserInfo(){
		$token=input('get.token');
		$tokenLists = new token();
		$tokenRes   = $tokenLists->getUserToken($token);
		$result = [
            	'userinfo'=>$tokenRes,
            ]; 
        return Response::returnData($result);die;
	}
	public function doLogin() {
		$data=input('post.');
		$lists=[
			'phone'    => $data['phone'],
			'password'     => $data['password'],
		];
		$list=new UserModel();
		$getLists=new Token();
		$info=$list->userlogin($lists);
		if (isset($info[$lists['phone']])) {
	        if ($lists['password'] == $info[$lists['phone']]['password']) {
	            $token = $getLists->setUserToken($info[$lists['phone']]);
	            $name=$info[$lists['phone']]['username'];
	            $result  = [
	                'token' => $token,
	                'name'  => $name,
	            ];
                return Response::returnData($result);die;
	        } else {
	            return Response::returnData([],1, '密码错误');die;
	        }
	    } else {
	        return Response::returnData([],2, '用户不存在');die;
	    }	
	}
	public function reg(){
		$data=input('post.');
		if (empty($data['phone'])||empty($data['password'])||empty($data['username'])) {
		return Response::returnData([],1, '没有数据');die;
		}
		$lists=[
			'phone'    => $data['phone'],
			'password' => $data['password'],
			'username' => $data['username'],
		];
		$list=new UserModel();
		$info=$list->checkPhone($lists['phone']);
		if($info){
			$getRes   = $list->addUser($lists);
			if ($getRes) {
				return Response::returnData([],0, '注册成功');die;
			}
		}else{
			return Response::returnData([],1, '电话已被使用');die;
		}
	}
	public function edit () {
        
    }
    public function doEdit () {
        
    }
    public function delete () {
        
    }
}