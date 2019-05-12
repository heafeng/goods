<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Cats as CatsModel;
use think\Db;
/**
 * 
 */
class Cats extends Controller
{
	public function lists() {
		$cats= new CatsModel();
		$catsres=Db::table('cats')->select();
		$catsTree=$cats->sort($catsres);
		// var_dump($catsTree,$catsres);die;
		$this->assign('catsres',$catsTree);
		return $this->fetch();
	}
	public function add() {
		$cats=new CatsModel();
		if (Request()->isPost()) {
			$data=input('post.');
			// var_dump($data);die;
			$add=$cats->add($data);
			if ($add) {
				$this->success('添加成功','lists');
			}else{
				$this->error('error');			
			}
		}
		$catsres=Db::table('cats')->select();
		// var_dump($catsres);die;
		$this->assign('catsres',$catsres);
		return $this->fetch();
	}

	
}