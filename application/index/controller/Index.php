<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\user\model\User;
use app\index\model\Adv;
use app\index\model\Product;
use app\index\model\Groom;
use think\Session;
use app\index\model\Shopcar;
use app\index\model\Shopaddr;
use app\index\model\Indent;
use app\index\model\Ingoods;

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
		$this->shopcar = new Shopcar();
		$this->address = new Shopaddr();
		$this->indent = new Indent();
		$this->ingoods = new Ingoods();
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
		//遍历购物车
		 $car = $this->shopcar->selCar($uid)->toArray();
		 //统计购物车数量
		 $count = count($car);
		  $this->assign('count', $count);
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
	public function myoppo()
	{
		 $user = Session::get('username');
		 $this->assign('user', $user);
		 $uid = Session::get('uid');
		
		 //我的订单
		 $indent = Indent::where('uid',$uid)->select()->toArray();
		// dump($indent);
		 $oid = Indent::field('oid')->where('uid',$uid)->select()->toArray();
		 //商品
		 $goods = $this->indent->goods($uid)->toArray();
		 $this->assign('indent',$indent);
		 //地址
		$ingoods = $this->indent->bianli($uid)->toArray();
		
		$this->assign('ingoods',$ingoods);
		
		$this->assign('goods',$goods);
		/*$picture = $this->ingoods->picture($uid)->toArray();
		dump($picture);*/
		//遍历购物车
		 $car = $this->shopcar->selCar($uid)->toArray();
		 //统计购物车数量
		 $count = count($car);
		  $this->assign('count', $count);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);

		return  $this->fetch();
	}

	public function subQian()
	{
		$data = Request::instance()->param();
		
		$this->indent->save(['status'=>3],['id' =>  $data['id']]);
	}

	public function subCancle()
	{
		$data = Request::instance()->param();
		
		$this->indent->save(['status'=>4],['oid' =>  $data['oid']]);
	}


	public function address()
	{
		$uid = Session::get('uid');
		 $pid = input('pid');
		 $this->assign('pid',$pid);
		 $this->assign('uid',$uid);
		 //遍历购物车
		 $car = $this->shopcar->selCar($uid)->toArray();
		 //统计购物车数量
		 $count = count($car);
		 //统计总价
		 $sum = $this->shopcar->selSum($uid);

		 $this->assign('car', $car);
		 $this->assign('count', $count);
		 $this->assign('sum', $sum);

		 //查收货地址
		 $addr = $this->address->selAddr($uid)->toArray();
		 $this->assign('addr',$addr);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);
		// 找出订单oid
		$indentid = Indent::field('id,oid')->order('id desc')->find()->toArray();
		
		$oid = $indentid['oid'];
		$this->assign('oid',$oid);
		//查商品清单
		$list = Ingoods::where('oid',$oid)->select()->toArray();
		//	订单总价
		$total = Ingoods::where('oid',$oid)->sum('price');
		$this->assign('total',$total);
		//订单数量
 		$countlist = count($list);
 		$this->assign('countlist',$countlist);
		$this->assign('list',$list);
		return  $this->fetch();
	}


	public function delAddr()
	{
		$data = Request::instance()->param();
		
		Shopaddr::destroy($data['addr_id']);
	}


	public function info()
	{
		return  $this->fetch();
	}
}
