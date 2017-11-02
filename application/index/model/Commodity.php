<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Commodity extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function comtoattr()
	{
		return $this->hasMany('Comtoattr','cid','cid');
	}
	public function checkpid($cid)
	{
		return $this->where('cid',$cid)->value('pid');
	}

	public function attr()
	{
		return $this->belongstoMany('Attr','Comtoattr','aid','cid');
	}

	public function arraypid($pid)
	{
		return $this->where('pid',$pid)->select();
	}
	
	public function selMoney($id)
	{
		return $this->field('attrid,money')->where('attrid',$id)->select();
	}

	public function selCommod($cid)
	{
		return $this->field('cid,attrid,money,stock')->where('cid',$cid)->select();
	}
	//库存
	public function selStock($pid)
	{
		return $this->field('stock')->where('pid',$pid)->select();
	}

	public function selCid($attrid,$pid)
	{
		return $this->field('cid')->where('pid',$pid)->where('attrid',$attrid)->select();
	}

	public function selPrice($pid)
	{
		return $this->field('money')->where('pid',$pid)->select();
	}

}