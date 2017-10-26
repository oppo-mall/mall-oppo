<?php
namespace app\admin;
use think\Controller;
use think\Session;
use app\admin\model\User;
/**
* 
*/
class Head extends Controller
{
	protected $user;
    protected $userinfo;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
	}
	public function head()
    {	
    	if(!Session::has('uid','admin')){
    		//返回重新登录
    		$this->redirect('Index/index/index');

    	};
    	$uid = Session::get('uid','admin');
    	$userobj = $this->user->checkId($uid);
    	$udertype = $userobj->udertype;
    	$update_time = $userobj->update_time;

    	$userinfo = $this->user->checkAll($uid);
        $userinfo['udertype'] = $udertype;
        $userinfo['update_time'] = $update_time;
        $this->userinfo = $userinfo;

    	foreach ($userinfo as $key => $value) {
    	$this->assign($key,$value);
    	}
    }
	
}

