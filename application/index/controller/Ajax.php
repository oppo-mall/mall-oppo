<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\User;
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
	function user()
	{
		$data = Request::instance()->param();
		$name = $data['param'];
		$userinfo = $this->user->checkAll($name);	
		if (empty($userinfo)) {
			echo json_encode(['msg'=>'用户不存在','status'=>'1']);
		} else {
			echo json_encode(['msg'=>'可以登录','status'=>'0']);
		}
	}
}