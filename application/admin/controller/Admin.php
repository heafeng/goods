<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Db;
// use app\admin\Controller\Common;


/**
 * 
 */
class Admin extends Controller
{
	 
	public function text() {
		$a=[1,3,4,5,8,9,2];
		$b=[];
		$c=[];
		foreach ($a as $key => $value) {
			$b[$value]=1;
		}
		// var_dump($b);die;
		foreach ($b as $key => $value) {
			$d=7-$key;
			if (isset($d,$a)) {
				// echo "123";die;
				$c[$key]=$d;
				var_dump($c);die;
				// unset($value);
			}
			// unset($value);
		}
		var_dump($c);die;
	}
	public function test(){
		$arr1=[];
		$arr2=[];
		$arr=[5,2,3,7,6];
		foreach ($arr as $key => $value) {
			array_push($arr1, $value);
		}
		// var_dump($arr1);die;
		if (!empty($arr2)) {
			array_pop($arr2);
		}else{
			if (!empty($arr1)) {
				array_push($arr2, array_pop($arr1));
			}
		}
		array_pop($arr2);
		if (empty($arr2)) {
			echo "成功";
		}else{
			echo "失败";
		}
		// $arr="()[{)}][]";
		// $arr=str_split($arr);
  //       $maps=[
  //           "("=>")",
  //           "{"=>"}",
  //           "["=>"]",
  //           ")"=>"(",
  //           "}"=>"{",
  //           "]"=>"[",];
  //       $tmp = [];
  //       foreach ($arr as $key => $value) {
  //           $first=array_shift($arr);
  //           if ((!empty($tmp))&&(isset($tmp[$maps[$first]]))) {
  //               array_pop($tmp);
  //           }else{
  //               $tmp[$first]=1;
  //           }
  //       }
  //       var_dump($tmp);
  //       if(empty($tmp)){
  //           die("匹配成功");
  //       }else{
  //           die("匹配失败");
  //       }

		// $a="({}){}[]";
		// $b=str_split($a);
		// // var_dump(end($b));die;
		// $tep=[];
		// $tmp=[];
		// $lis=['('=>')','{'=>'}','['=>']',''=>']'];
		// foreach ($b as $key => $value) {
		// 	// array_push($tep,$value);
		// 	if (empty($tep)) {
		// 		echo "123";
		// 		array_push($tep,$value);
		// 		// var_dump($b);die;
		// 		// $tmp=array_combine(end($tep),$value);
		// 		// var_dump($tmp);die;
		// 	}else{
		// 		echo "456";

		// 		var_dump( array_combine(end($tep),$value));die;
				
		// 	}
		// }
		// var_dump($tep);die;

	}
	public function lst() {
		// phpinfo();die;
		// if(!session('username')) {
		// 		$this->error('error','Admin/login');
		// 	}
		// $arr=Db::table('Word')->select();
		// $this->assign('he',$arr);
		$admin=new AdminModel();
		$adminres=$admin->getadmin();
		$this->assign('adminres',$adminres);
		return $this->fetch('admin/newlist');
	}
	public function star() {

		return $this->fetch();
	}
	public function reg() {

		if(Request()->isPost()){
			$data=input('post.');
			// var_dump($data);die;
			$list=new AdminModel();
			$arr=$list->addadmin($data);
			if($arr){
				$this->success('success','Admin/login');
			}else{
				$this->error('error');
			}
			return;

		}
		return $this->fetch();
	}
	public function login() {
		if(Request()->isPost()) {
			$lists=input('post.');
			// var_dump($lists);die;
			$data=Db::table('admin')->where('phone',$lists['phone'])->find();
			$list=new AdminModel();
			$info=$list->login($lists);
			// var_dump($info);die;
			// Session::set('username',$lists['username']);
			if($info==1){
				return $this->error('用户不存在');
			}
			if($info==2){
				Session::set('username',$data['username']);
				return $this->error('登陆成功','lst');
			}
			if($info==3){
				return $this->error('密码错误');
			}
			// if($lists['password']=$data['password']) {
			// 	$this->success('login success',url('star'));
			// }else{
			// 	$this->error('failed');
			// }
			// // dump($data);die();
			// return;
		}
		return $this->fetch();
	}
	
	public function outlogin() {
		session(null);
		return $this->fetch('login');
	}
	public function edit($id) {
		if(Request()->isPost()) {
			$data=input('post.');
			$list=new AdminModel();
			$res=$list->updateAdmin($id,$data);
			// $res=db('admin')->update($data);
			if(!$res==false){
				$this->success('修改成功',url('lst'));
			}else{
				$this->error('修改失败');
			}

			return;
		}
		$admin=db('admin')->find($id);
		if(!$admin) {
			$this->error('该管理员不存在');
		}
		// dump($admin);die;
		$this->assign('admin',$admin);
		return $this->fetch();
	}
	public function delete($id) {
		$list=new AdminModel();
		$words=$list->delAdmin($id);
		// $words=Db::table('admin')->delete($id);
		if($words){
				$this->success('删除成功',url('lst'));
			}else{
				$this->error('删除失败');
			}
	}
}