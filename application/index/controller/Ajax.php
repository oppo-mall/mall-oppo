<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\User;
use app\index\model\Comment;
/**
* 
*/
class ajax extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
		$this->comment= new Comment($_POST);
	}	
	
	function register()
	{
		$data = Request::instance()->param();
		$name = $data['param'];
		$userinfo = $this->user->checkAll($name);	
		if (empty($userinfo)) {
			echo json_encode(['status'=>'1']);
		} else {
			echo json_encode(['status'=>'0']);
		}
	}

	//一级评论
	function comments()
	{
		$data = Request::instance()->param();
		//dump($data);
		
		if (!empty($data)) {
			$this->comment->insCom($data);
			echo json_encode($data);
		} 
		
	}
	//追加评论
	function addcomments()
	{
		$data = Request::instance()->param();
		//dump($data);
		
		if (!empty($data)) {
			$this->comment->insAddcom($data);
			echo json_encode($data);
		} 
		
	}
}