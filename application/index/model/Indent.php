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
	
	public function selDetails($uid,$getid)
	{
		return Db::view('indent','uid,oid,addr_id')
				->view('ingoods',['oid','color','name','quantity'],'indent.oid=ingoods.oid')
				->view('shopaddr',['addr_id','address_detail','receiver','tel'],'indent.addr_id=shopaddr.addr_id')
				->where('uid',$uid)
				->where('oid',$getid)
				->select();
	}
	public function checkAll($uid)
	{
		return $this->where('uid',$uid)->select();
	}
	public function shopaddr()
	{
		return $this->hasOne('shopaddr','addr_id','id');
	}
	public function ingoods()
	{
		return $this->hasMany('ingoods','oid');
	}	

	public function bianli($uid)
	{

		return Db::view('indent','*')
			->view('shopaddr',['addr_id','receiver','tel','email','address_detail'],'indent.addr_id=shopaddr.addr_id')
			->where('indent.uid',$uid)
			->select();
	}

	public function goods($uid)
	{

		return Db::view('indent','*')
			->view('ingoods',['oid','name','price','img','cid','color',],'indent.oid=ingoods.oid')
			->where('indent.uid',$uid)
			->select();
	}

	public function alreadyBuy($uid)
	{
		
	}
	
}

