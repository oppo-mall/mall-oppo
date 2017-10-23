<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
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
		//防止get注入
		if (Request::instance()->isGet()){
			return $this->fetch();
		}
		

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

			if (($userinfo['password'] !== $password) && $userinfo['is_log'] == 0) {
				$this->user->upip($userinfo['uid']);
				Session::set('username',$name);
				if ($userinfo['udertype'] == '1') {
					Session::set('uid',$userinfo['uid'],'admin');
				}

				Session::set('uid',$userinfo['uid']);
				Session::set('level',$userinfo['level']);
				// Session::set('gold',$userinfo['gold']);
				Session::set('icon',$userinfo['icon']);
				Session::set('nickname',$userinfo['nickname']);
				if ($userinfo['udertype'] == 1) {
					$this->success('管理员登录成功','Index/index');
				} elseif ($userinfo['udertype'] == 2) {
					$this->success('卖家登录成功','Index/index');
				}
				$this->success('登录成功','Index/index');
			} else {
				$this->error('登录失败');
			}

		}
	}

}
