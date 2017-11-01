<?php
namespace app\user\controller;
use think\Request;
use think\Controller;
use app\user\model\User;
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
	}	
	//查询用户名是否存在
	public function user()
	{
		$data = Request::instance()->param();
		$name = $data['param'];
		$userinfo = $this->user->checkAll($name);	
		if (empty($userinfo)) {
			echo json_encode(['msg'=>'用户不存在','status'=>'1']);
		} else {
			echo json_encode(['msg'=>'用户存在','status'=>'0']);
		}
	}
	//查询密码名是否正确
	public function password()
	{
		$data = Request::instance()->param();
		$pass = md5($data['password']);
		
		$name = $data['username'];
		$password = $this->user->checkAll($name);	
		
		if ($pass == $password['password']) {
			echo json_encode(['msg'=>'密码正确','status'=>'0']);
		} else {
			echo json_encode(['msg'=>'密码错误','status'=>'1']);
		}
	}
	//注册时用户是否存在
	public function register()
	{
		$data = Request::instance()->param();
		$name = $data['param'];
		$userinfo = $this->user->checkAll($name);	
		if (empty($userinfo)) {
			echo json_encode(['msg'=>'可用','status'=>'1']);
		} else {
			echo json_encode(['msg'=>'已被注册','status'=>'0']);
		}
	}
	//手机验证
	public function phone()
	{
		// $to = Request::instance()->param()['param'];
		$to = input('param.param');
		$param = mt_rand(1000,9999);
		$phone = phoneCode($to,$param);
		if ($phone) {
			return $param;
		} else {
			return 0;
		}
	}
	//邮箱验证
	public function mail()
	{
		
		$smtpemailto = Request::instance()->param()['param'];
		$param = mt_rand(1000,9999);
		$mail = mailCode($smtpemailto,$param);
		if ($mail) {
			return $param;
		} else {
			return 0;
		}

	}

	
}