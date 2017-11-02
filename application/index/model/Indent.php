<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Indent extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	//插入订单商品表
	public function insIndent($indent_table)
	{
		$this->allowField(true)->save($indent_table);
	}
	//查商品清单
	public function selList($uid)
	{
	  //return	Indent::join('ingoods','indent.oid=ingoods.oid','RIGHT')->select();
		return Db::view('indent','oid,uid,count')
			->view('ingoods',['uid','oid','price','quantity','color','img','configure','name','link','cid'],'indent.oid=ingoods.oid')
			->where('uid',$uid)
			->select();
	}
	public function ingoods()
	{
		return $this->hasMany('Ingoods','oid');
	}
	public function checkuid($oid)
	{
		return $this->where('oid',$oid)->find();
	}
	
}

//订单表::join(‘订单商品表’，‘订单表.订单号=订单商品表.订单号’，‘LEFT’)->select()
