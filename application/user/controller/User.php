<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use app\user\model\User as UserModel;
use think\Session;

class User extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel();
	}

	public function reg()
	{
<<<<<<< HEAD

=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
		return $this->fetch();
	}
	public function doreg()
	{
<<<<<<< HEAD

		$data = Request::instance()->param();
		
		$pass = input('param.password');
		$password = md5($pass);
		$data['password'] = $password;
		$data['regip'] = $_SERVER['REMOTE_ADDR'];
		if (!empty($data['username'])) {
			$name = $data['username'];
		} else if (!empty($data['email'])) {
			$name = $data['email'];
		} else if (!empty($data['tel'])) {
			$name = $data['tel'];
		}
		$reg = $this->user->insReg($data);
		//查询用户信息
		$userinfo = $this->user->checkAll($name);
		dump($userinfo);
		Session::set('uid',$userinfo['uid']);
		Session::set('username',$userinfo['username']);
		Session::set('level',$userinfo['level']);
		Session::set('icon',$userinfo['icon']);
		Session::set('nickname',$userinfo['nickname']);

		//$this->redirect('index/index/index');
	}
	public function log()
	{

=======
		
		
	}
	public function log()
	{
				//防止get注入
		if (Request::instance()->isGet()){
			return $this->fetch();
		}
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
		return $this->fetch();
	}

		//登录
	public function dolog()
	{
<<<<<<< HEAD
		if (Request::instance()->isGet()){
		return $this->fetch('log');
	}
=======
		//防止get注入
		if (Request::instance()->isGet()){
			return $this->fetch('log');
		}
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
		//限定传入类型
		if (Request::instance()->isPost()){
			$post = Request::instance()->param(); 
			$name = $post['username'];
<<<<<<< HEAD

			$password = md5($post['password']);
			//dump($password);
			//查询用户信息
			$userinfo = $this->user->checkAll($name);
			//dump($userinfo);
			if (($userinfo['password'] == $password) && $userinfo['is_log'] == 0) {

=======
			$password = $post['password'];
			//查询用户信息
			$userinfo = $this->user->checkAll($name);

			if (($userinfo['password'] !== $password) && $userinfo['is_log'] == 0) {
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
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
<<<<<<< HEAD

				Session::set('udertype',$userinfo['udertype']);
				if ($userinfo['udertype'] == 1) {
					$this->success('管理员登录成功','index/index/index');
				} elseif ($userinfo['udertype'] == 2) {
					$this->success('卖家登录成功','index/index/index');
				}
				$this->success('登录成功','index/index/index');
			} else {

				$this->error('登录失败');
			}

		}   
	}
=======
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

>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	public function logout()
	{
		Session::clear();
		$this->redirect('/index/index/index');
	}

}