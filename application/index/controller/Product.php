<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Product as ProductModel;
use app\index\model\Adv;
use app\index\model\Groom;
use app\index\model\Shopcar;
use app\index\model\Category;

use think\Session;
class Product extends Controller
{
	public function _initialize()
	{
		parent::_initialize();
		$this->product = new ProductModel();
		$this->adv = new Adv();
		$this->grooms = new Groom();
		$this->shopcar = new Shopcar();
		$this->category = new Category();
	}

	public function products()
	{

		$uid = Session::get('uid');
		//产品系列和分类
		$big = $this->category->selCat();
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

		//遍历购物车
		 $car = $this->shopcar->selCar($uid)->toArray();
		 //统计购物车数量
		 $count = count($car);
		  $this->assign('count', $count);
		
		return $this->fetch();
	}

		

}