<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Product as ProductModel;
use app\index\model\Adv;
use app\index\model\Groom;
use think\Session;
class Product extends Controller
{
	public function _initialize()
	{
		parent::_initialize();
		$this->product = new ProductModel();
		$this->adv = new Adv();
		$this->grooms = new Groom();
	}

	public function products()
	{
		 // $user = Session::get('username');
		 // $this->assign('user', $user);
		//产品系列和分类
		$big = $this->product->selCat();
		$small = $this->product->selRes();

		$this->assign('big', $big);
		$this->assign('small', $small);
		//dump($small);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);
		//中等广告
		$adv = $this->adv->selMid();
		for ($i=0; $i < 3; $i++) { 
			$res = json_decode($adv[$i]['path']);
			$this->assign('url'.$i.'1',$res->url1);
			$this->assign('url'.$i.'2',$res->url2);
			$this->assign('alt' . $i, $adv[$i]['alt']);
			$this->assign('title'. $i, $adv[$i]['title']);
		}
		return $this->fetch();
	}

		
}