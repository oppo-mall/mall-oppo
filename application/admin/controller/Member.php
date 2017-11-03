<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\Head;
use app\admin\model\User; 
use think\Request;
/**
* 
*/
class Member extends Controller
{
	
	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
        $this->head = new Head();
        
	}
	public function memberlist()
	{
		$this->head->head();
		$userinfo = $this->user->checkuser();

		$this->assign('userinfo',$userinfo);
		return $this->fetch();
	}
	public function islog()
	{
		$data = Request::instance()->param();
		
		$res = $this->user->islog($data);
		if ($res == 1) {
			echo json_encode(['status'=>0]);
		} else {
			echo json_encode(['status'=>1]);
		}
	}
	public function membershow()
	{
		$this->view->engine->layout(false);
		$uid = Request::instance()->param();
		$userinfo = $this->user->checkAll($uid['uid']);
		$this->assign('userinfo',$userinfo);
		return $this->fetch();
	}
	public function memberadd()
	{
		$this->view->engine->layout(false);
		$uid = Request::instance()->param();
		$userinfo = $this->user->checkAll($uid['uid']);
		$this->assign('userinfo',$userinfo);
		return $this->fetch();
	}
	public function infoedit()
	{
		$data = Request::instance()->param();
		$path = $this->addpic();
		$info = Request::instance()->param();
		dump($info);
		die;
		$res = $this->user->usermodify($info);
		

		echo json_encode($data);
		
	}
	protected function addpic()
    {
        $file = request()->file();
        //移动到框架应用根目录/public/uploads/ 目录下
        $info = $file['file-2']->move('uploads'); 
        if($info){
             $path ='/' . $info->getPathname();
             $this->picPath = $path;
             echo $path;
        }else{
            echo $file->getError();
        }              
    }

    public function changepassword()
    {
		$this->view->engine->layout(false);
		$uid= Request::instance()->param();
		$info = $this->user->checkAll($uid['uid']);
		$this->assign('info',$info);
    	return $this->fetch();
    }
    public function change()
    {
    	$password= Request::instance()->param();
    	$uid = $password['uid'];
    	if ($password['newpassword'] != $password['newpassword2']) {
    		return false;
    	} else {
    		$password = md5($password['newpassword']);
    		$res = $this->user->passchange($uid,$password);
    		if ($res) {
    			return true;
    		} else {
    			return false;
    		}
    	}
    }
    public function ruandeluser()
    {
    	$uid=Request::instance()->param();
    	$res = $this->user->ruandeluser($uid['uid']);
    }
    public function memberdel()
    {
    	$this->head->head();
    	$delinfo = $this->user->checkdelete();
    	//dump($delinfo);die;
    	$this->assign('delinfo',$delinfo);
    	return $this->fetch();
    }
    public function replay()
    {
    	$uid = Request::instance()->param();
    	dump($uid);
    	$this->user->replay($uid['uid']);
    }
    public function readydel()
    {
    	$uid = Request::instance()->param();
    	$this->user->readydel($uid['uid']);
    }

}