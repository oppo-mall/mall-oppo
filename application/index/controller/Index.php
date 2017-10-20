<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User;

class Index extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
	}
	public function index()
	{
		return $this->fetch();
	}
	public function log()
	{

	}
	//登录
	public function dolog()
	{
		//防止get注入
		if (Request::instance()->isGet()){
			return $this->fetch('log');
		}

		//限定传入类型
		if (Request::instance()->isPost()){

			$post = Request::instance()->param(); 
			$name = $post['username'];
			$password = $post['password'];
			//查询用户信息
			$userinfo = $this->user->checkAll($name);
			if ($userinfo['password'] == md5($password)) {
				$this->success('登录成功','Index/index');
			} else {
				$this->error('登录失败');
			}

		}
	}

}
