<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\user\model\User;
use app\index\model\Adv;
use app\index\model\Product;
use app\index\model\Groom;
use think\Session;

class Index extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
		$this->adv = new Adv();
		$this->product = new Product();
		$this->grooms = new Groom();
	}
	public function index()
	{
		 $user = Session::get('username');
		 $this->assign('user', $user);
		//dump($user);
		//查轮播图广告
		$advance = $this->adv->selBig();
		for ($i=0; $i < 4; $i++) { 
			$this->assign('path'. $i , $advance[$i]['path']);
			$this->assign('alt' . $i, $advance[$i]['alt']);
			$this->assign('title'. $i, $advance[$i]['title']);
		}
		//查小图广告
		$adv = $this->adv->selSmall();
		//dump($adv);
		for ($i=0; $i < 3; $i++) { 
			$this->assign('paths'. $i , $adv[$i]['path']);
			$this->assign('alts' . $i, $adv[$i]['alt']);
			$this->assign('titles'. $i, $adv[$i]['title']);
		}
		//查推荐机型
		$groom = $this->grooms->selGroom();
		
		$this->assign('groom', $groom);
		return $this->fetch();
	}

	
	

	public function service()
	{
		 $user = Session::get('username');
		 $this->assign('user', $user);
		return $this->fetch();
	}

	
	

}
