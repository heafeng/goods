<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Word as WordAdmin;
use think\Db;
use think\Session;
use FileName\FileName;
/**
 * 
 */
class Word extends Controller
{
	
	public function add() {
		return $this->fetch();
	}
	public function save() {
		// $file = request()->file('image');
		// if(Request()->isPost()){
		// 	$file = request()->file('img');
		// 	if($file){
	 //        	$info = $file->validate(['ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');	        	
  //       		$inno=$info->getSaveName();
  //       		$file='uploads/'.$inno;

	 //    	}
			$file=FileName::upload('img');
	    	$data=input('post.');
	    	$data['img']=$file;
	    	
			// $data[]=(['img'=>$file]);
			// var_dump($data);die;
			// $data = ['foo' => 'bar', 'bar' => 'foo'];
			// Db::table('Word')->insert($data);
			$word=new WordAdmin();
			
			$adminres=$word->aad($data);
			
		
		$this->success('添加成功','word/lit');
	}
	public function lit() {
		// $adminres=Db::table('Word')->select();
		// $this->assign('adminres',$adminres);
		$word=new WordAdmin();
		// if(class_exists('ws')){
		// 	echo "ok";
		// }else{
		// 	return $this->fetch('admin/login');
		
		// }
		$wordres=$word->getwords();
		// var_dump($wordres);die;
		$this->assign('wordres',$wordres);
		// return $this->fetch();
		return $this->fetch();
	}
	public function update($id) {
		if(Request()->isPost()) {
			$data=input('post.');
			// dump($data);die; 
			// todo
			$word=new WordAdmin();
			$words=$word->updateWords($id,$data);
			//$res=db('word')->update($data);
			if(!$words==false){
				$this->success('修改成功',url('lit'));
			}else{
				$this->error('修改失败');
			}

			return;
		}
		$word=db('word')->find($id);
		if(!$word) {
			$this->error('该信息不存在');
		}
		
		$this->assign('word',$word);
		return $this->fetch();
	}
	public function delete($id) {

		$word=new WordAdmin();
		$words=$word->delWords($id);
		// $words=Db::table('word')->delete($id);
		if($words ){
			$this->success('删除成功',url('lit'));
		}else{
			$this->error('删除失败');
		}
	}
	public function upload() {
    	// 获取表单上传文件 例如上传了001.jpg
    	$file = request()->file('image');
    
    	// 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){ // 成功上传后 获取上传信息	           	            
	            $file=$info->getSaveName();
	            $file='uploads/'.$file;
	            $file[]=(['img'=>$file]);
	            var_dump($file);die;      	          
	        }else{// 上传失败获取错误信息
	            
	            echo $file->getError();
	        }
	    }
	    return $this->fetch();
	}
}