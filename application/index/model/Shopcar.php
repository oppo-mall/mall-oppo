<?php
namespace app\index\model;
use think\Model;
use think\Db;
<<<<<<< HEAD
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
=======


class Shopcar extends Model
{
	public function selCar($uid)
	{
		return Db::view('shopcar','uid,gid,quantity,aid')
				->view('goods',['pname','old_price','price','size','color','inter','gid','pid'],'shopcar.gid=goods.gid')
				->view('img',['path_url','aid','pid'],'goods.pid=img.pid')
				->where('uid',$uid)
				->select();

>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	}
}