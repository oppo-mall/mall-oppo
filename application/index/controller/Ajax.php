<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use app\index\model\Comment;
use app\index\model\Comtoattr;
use app\index\model\Commodity;
use app\index\model\Attr;
use app\index\model\Shopcar;
/**
* 
*/
class ajax extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->comment= new Comment($_POST);
		$this->coloraid= new Comtoattr();
		$this->commod= new Commodity();
		$this->attr = new Attr();
		$this->shop = new Shopcar($_POST);
	}	
	
	function register()
	{
		$data = Request::instance()->param();
		$name = $data['param'];
		$userinfo = $this->user->checkAll($name);	
		if (empty($userinfo)) {
			echo json_encode(['status'=>'1']);
		} else {
			echo json_encode(['status'=>'0']);
		}
	}

	//一级评论
	function comments()
	{
		$data = Request::instance()->param();
		//dump($data);
		
		if (!empty($data)) {
			$this->comment->insCom($data);
			echo json_encode($data);
		} 
		
	}
	//追加评论
	function addcomments()
	{
		$data = Request::instance()->param();
		//dump($data);
		
		if (!empty($data)) {
			$this->comment->insAddcom($data);
			echo json_encode($data);
		} 
		
	}

	function color() 
	{
		$aid= Request::instance()->param()['aid'];
		$pid= Request::instance()->param()['pid'];
		
		return $attr = $this->coloraid->color($aid,$pid)->toArray();
	}
	function money() 
	{
		$id= Request::instance()->param();
		//dump($id);
		$attr = $this->commod->selMoney($id['id'])->toArray();

		//dump($attr);
		return $attr[0]['money'];
	}


	function selStock()
	{
		$id= Request::instance()->param();
		$aid = $id['aid'];
		$pid = $id['pid'];
		$cid = [];
		$com = Comtoattr::all(['aid'=>$aid,'pid'=>$pid])->toArray();
		foreach ($com as $key => $value) {
			$cid[] = $value['cid'];
		}
		//dump($cid);三位数组
		foreach ($cid as $key => $value) {
			$res[]= $this->commod->selCommod($value)->toArray();

		}
		//二维数组
		foreach ($res as $k => $val) {
			$res[$k] = $val['0'];
		}
		
		return $res;
	}
	//加入购物车
	public function addBuy()
	{
		$data = Request::instance()->param();
		$attrid = $data['attrid'];
		$pid = $data['pid'];

		$cid = $this->commod->selCid($attrid,$pid)->toArray();
		
		$cid = $cid[0]['cid'];
		$data['cid'] = $cid;
		$res = $data;
		dump($data);
		$result = $this->shop->insCar($res);
		
		return $res;


	}
}
