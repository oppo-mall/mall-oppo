<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Shopcar extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function selCar($uid)
	{
		return $this->field('*')->where('uid',$uid)->select();
	}

	public function insCar($res)
	{
		$this->allowField(true)->save($res);
	}

	public function selSum($uid)
	{
		return $this->where('uid',$uid)->sum('price');
	}

	public function selIns($str)
	{
		return $this->where('id','in',$str)->select();
	}
}