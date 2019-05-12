<?php

namespace app\index\controller;
use think\Controller;
use app\index\model\User as UserModel;
use FileName\FileName;
use userConter\UserConter;
use app\index\model\Token;
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
            'error'=> 0,
            'msg'  => '',
            'data' =>[
            	'userinfo'=>$tokenRes,
            ],
            ]; 
            echo json_encode($result);
            die();
	}
	public function login() {
		return $this->fetch();
	}
	public function doLogin() {
		phpinfo();die;
		$data=input('post.');
		$lists=[
			'phone'    => $data['phone'],
			'password'     => $data['password'],
		];
		// var_dump($lists);die;
		$result=[
			'error'=>0,
			'msg'=>'',
			'data'=>'',
		];
		$list=new UserModel();
		$getLists=new Token();
		$info=$list->userlogin($lists);
		// var_dump($info[$lists['phone']]);die;
		if (isset($info[$lists['phone']])) {
			// var_dump($lists['password'],$info[$lists['password']]);die;
	        if ($lists['password'] == $info[$lists['phone']]['password']) {
	            // $token = UserConter::getIntance()->setUserInfo($info[$lists['phone']]);
	            $token = $getLists->setUserToken($info[$lists['phone']]);
	            $name=$info[$lists['phone']]['username'];
	            // var_dump($token);die;
	            $result['data']  = [
	                'token' => $token,
	                'name'  => $name,
	            ];
	        } else {
	            $result['error']  = 1;
	            $result['msg']  = '密码错误';
	        }
	    } else {
	        $result['error']  = 2;
	        $result['msg']  = '用户不存在';
	    }
		return json_encode($result);die;	
	}
	public function reg(){
		$data=input('post.');
		if (empty($data['phone'])||empty($data['password'])||empty($data['username'])) {
			$result=[
			'error'=>1,
			'msg'=>'没有数据',
			'data'=>'',
		];
		return json_encode($result);die;
		}
		$lists=[
			'phone'    => $data['phone'],
			'password' => $data['password'],
			'username' => $data['username'],
		];
		$result=[
			'error'=>0,
			'msg'=>'',
			'data'=>'',
		];
		$list=new UserModel();
		$getLists = new UserModel();
		$info=$list->checkPhone($lists['phone']);
		if($info){
			$getRes   = $getLists->addUser($lists);
			if ($getRes) {
				$result['msg']='注册成功';
			}
			return json_encode($result);die;
		}else{
			$result['msg']='电话已被使用';
		}
		return json_encode($result);die;
	}
	public function edit () {
       
    }
    public function doEdit () {
        
    }
    public function delete () {
        
    }
}