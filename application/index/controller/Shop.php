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
use app\index\model\Protocom;
use app\index\model\Indent;
use app\index\model\Ingoods;
use app\index\model\Shopaddr;
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
		$this->protocom = new Protocom();
		$this->indent = new Indent();
		$this->goods = new Ingoods();
		$this->address = new Shopaddr();
	}


	public function shop()
	{
		$uid = Session::get('uid');
		$cid = input('cid');
		$this->assign('cid',$cid);
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

	public function details()
	{
		if (Session::has('uid')) {
			$uid = Session::get('uid');
			$user = Session::get('username');
			$this->assign('user', $user);
			
		} else {
			$uid = 0;
		}
		$this->assign('uid', $uid);
		$pid = input('pid');
		//$aid = input('aid');
		$cid = input('cid');

		$this->assign('pid',$pid);
		//$this->assign('cid', $cid);
		//dump($pid);dump($aid);die;
		if (empty($cid)) {
			$cid = $this->protocom->checkcid($pid)->cid;
		}

		// 根据cid 找到pic 找所有的同类手机
		$pname = $this->commodity->arraypid($pid);
	
		foreach ($pname as $key => $value) {
		 	$com = Commodity::find($value['cid']);
			$attrs = $com ->attr->toArray();

		}

		//通过空数组保存参数属性
		$color = [];
		$link =[];
		$configure = [];
		$size = [];
		
		$com = Commodity::all(['pid'=>$pid]);

		foreach ($com as $key => $value) {
			$attr = $value->attr->toArray();
					
			foreach ($attr as $key => $value) {

				switch ($value['type']) {
					case '0':
						if (!in_array($value['attrname'],$color)) {
							array_push($color, $value['attrname']);
							$coloraid[] = $value['aid'];
						}
						break;
					case '1':
						if (!in_array($value['attrname'],$link)) {
							array_push($link, $value['attrname']);
							$linkaid[] = $value['aid'];
						}
						break;
					case '2':
						if (!in_array($value['attrname'],$configure)) {
							array_push($configure, $value['attrname']);
							$configureaid[] = $value['aid'];
						}
						break;
					case '3':
						if (!in_array($value['attrname'],$size)) {
							array_push($size, $value['attrname']);
							$sizeaid[] = $value['aid'];
						}
						break;
				}
			}	

		}
	
		$color = array_combine($coloraid,$color);
		$link = array_combine($linkaid,$link);
			/*if (empty($size)) {
				$size = array_combine($sizeaid,$size);
			}*/
		
		$configure = array_combine($configureaid,$configure);
		$this->assign('color',$color);
		$this->assign('link', $link);
		$this->assign('size',$size);
		$this->assign('configure', $configure);
		//上部分左图
		$small = $this->product->selSp($pid,$cid);
		//$small = $this->comtoattr->color($pid,$aid);
		//dump($small);
		$this->assign('small',$small);
		//产品介绍图
		$big = $this->product->selBig($pid);
		$this->assign('big', $big);
		//产品参数图
		$param = $this->product->selParam($pid);
		$this->assign('param',$param);



		//一级评论; 
		$comment = $this->product->selComment($pid)->toArray();
		
		foreach ($comment as $key => $value) {
			$comment[$key]['create_time'] = date('Y-m-d',$value['create_time']);
		}
		$this->assign('comment',$comment);
		//二级评论
		$erji = $this->comment->selCom($pid)->toArray();
		$this->assign('erji', $erji);



		//用户是否已经评论过
		$res = $this->comment->selIscomment($uid)->toArray();
		$this->assign('res', $res);
		$pname = $this->product->selRes()->toArray()[0]['pname'];
		//dump($pname);
		$this->assign('pname',$pname);
		//库存
		$stock = $this->commodity->selStock($pid)->toArray()[0]['stock'];
		$this->assign('stock',$stock);
		$price = $this->commodity->selPrice($pid)->toArray()[0]['money'];
		$this->assign('price',$price);
		//dump($stock);
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

	public function car()
	{
		 $user = Session::get('username');
		 $this->assign('user', $user);
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

		 //查商品清单
		//$list = Ingoods::where('uid',$uid)->select()->toArray();
	 	 $list = $this->indent->selList($uid)->toArray();
		 $countlist = count($list);
		 //dump($list);
		$this->assign('list',$list);
		$this->assign('countlist',$countlist);
		//查推荐机型
		$groom = $this->grooms->selGroom();
		$this->assign('groom', $groom);
		//

		return  $this->fetch();
	}

	public function insIndent()
	{
		$data = Request::instance()->param();

		$res = $data['li'];
		$str = join(',', $res);
		//选择结算的商品信息
		$igoods = $this->shopcar->selIns($str)->toArray();
		$count = count($igoods);
		$oid =time() . mt_rand(1000,9999);
		//空数组将订单表字段保存起来
		$indent_table = [];
		$indent_table['oid'] = $oid;
		$indent_table['uid'] = $igoods[0]['uid'];
		$indent_table['count'] = $count;
		//销毁购物车表的自增id，
		for ($i=0; $i < $count; $i++) {
			unset($igoods[$i]['id']);
			$igoods[$i]['oid'] = $oid;
		}
	
		//插入订单表
		$this->indent->insIndent($indent_table);
		
		//插入订单商品表
		$this->goods->saveAll($igoods);
		


		$indentuid = Indent::where('oid',$oid);
		$res = $indentuid->ingoods;
			dump($indentuid);
		dump($res);
		//return $oid;
		//return $oid;
		
	}
	
	public function payfor()
	{
		$data = Request::instance()->param();
		dump($data);

		//$user->allowField(true)->save($_POST,['oid' => $oid]);
	}
}

 

