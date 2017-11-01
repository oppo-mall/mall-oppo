<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Product as ProductModel;
use app\index\model\Groom;
use app\index\model\Adv;
use app\index\model\Comment;
use app\index\model\Shopcar;
use app\index\model\Commodity;
use app\index\model\Comtoattr;
use think\Request;
use think\Session;
class Shop extends Controller
{
	public function _initialize()
	{

		parent::_initialize();
		$this->product = new ProductModel();
		$this->grooms = new Groom();
		$this->adv = new Adv();
		$this->comment = new Comment();
		$this->shopcar = new Shopcar();
		$this->commodity = new Commodity();
		$this->comtoattr = new Comtoattr();
	}


	public function shop()
	{
		$user = Session::get('username');
		$this->assign('user', $user);
		//查广告图
		$adv = $this->adv->selBigger();
		//dump($adv);
		$this->assign('adv' , $adv);
		//所有手机
		$all = $this->product->selAll();
		//dump($all);
		$this->assign('all',$all);
		//手机配件
		$parts = $this->product->selParts();
		$this->assign('parts', $parts);

		//查推荐机型
		$groom = $this->grooms->selGroom();
		
		$this->assign('groom', $groom);
	
		return $this->fetch();
	}

	public function details()
	{
		
		

		//商品id
		// $id = input('id');
		// $this->assign('id', $id
		// 
		
	
		//$pid = 5;
		
		$cid = 1;
		// 根据cid 找到pic 找所有的同类手机
		$pid = $this->commodity->checkpid($cid);
		$pname = $this->commodity->arraypid($pid);
		
		// foreach ($pname as $key => $value) {
		// 	$com = Commodity::find($value['cid']);
		// 	$attrs = $com ->attr->toArray();
		// 	dump($attrs);

		// }
		$color = [];
		$link =[];
		$configure = [];
		$size = [];

		$com = Commodity::all(['pid'=>$pid]);
		foreach ($com as $key => $value) {
			$attr = $value->attr->toArray();
			foreach ($attr as $key => $value) {
				// $attrs[] = [$value['type']=>$value['attrname'] ];
				
				//dump($attrs);
				switch ($value['type']) {
					case '0':
						if (!in_array($value['attrname'],$color)) {
							array_push($color, $value['attrname']);
						}
						break;
					case '1':
						if (!in_array($value['attrname'],$link)) {
							array_push($link, $value['attrname']);
						}
						break;
					case '2':
						if (!in_array($value['attrname'],$configure)) {
							array_push($configure, $value['attrname']);
						}
						break;
					case '3':
						if (!in_array($value['attrname'],$size)) {
							array_push($size, $value['attrname']);
						}
						break;
				}
			}	

		}
dump($color);
dump($link);
dump($configure);
dump($size);
  // dump($attrs);
		// $max = array_search(max($type), $type);
		// $arr = [];
		// foreach ($attrs as $key => $value) {
		// 	if (!array_key_exists($value[$key], $arr)) {
		// 		$arr[]= [$value[$key]=>$value];
		// 	}
			
		// }
		// //$res = $this->commodity->attrsid();
		// $id = 1;
		  // $this->assign('id', $id);
		  // $buys = $this->product->selBuys($id);
		  // $this->assign('buys', $buys);
die;			
		//商品页图片
		$small = $this->product->selSp($id);
		$big = $this->product->selBp($id);
		$this->assign('small', $small);
		$this->assign('big', $big);
		
		//商品页颜色
		$color = $this->product->selColor($id);
		$this->assign('color',$color);
		//商品尺寸
		$size= $this->product->selSize($id);
		$this->assign('size',$size);
		//商品网络
		$inter= $this->product->selInter($id);
		$this->assign('inter',$inter);
		$details = $this->product->selDe($id);
		//dump($details);
		$this->assign('details', $details);
		//商品页商品介绍超大图
		$large = $this->product->selLarge($id);
		$this->assign('large', $large);
		//商品页商品参数超大图
		$param = $this->product->selParam($id);
		$this->assign('param', $param);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);
		//手机评论，与追加的评论一级
		$comment = $this->product->selComment($id);
		$pages = $this->product->selPage($id);
		//dump($comment);
		$page = $pages->render();
		$this->assign('page', $page);

		$com = $this->comment->selCom($id);
		$this->assign('comment',$comment);
		$this->assign('com',$com);
		$count = $this->comment->selCount();
		$this->assign('count', $count);
		
		return $this->fetch();
	}

	public function car()
	{
		 $user = Session::get('username');
		 $this->assign('user', $user);
		 $uid = Session::get('uid');
		 $car = $this->shopcar->selCar($uid);
		 dump($car);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);

		return  $this->fetch();
	}
}

 