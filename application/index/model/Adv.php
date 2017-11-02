<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Adv extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	//首页轮播图
	public function selBig()
	{
		return $this->where('bid',1)->field('*')->select();
	}
	//小广告图
	public function selSmall()
	{
		return $this->where('bid',2)->field('*')->select();
	}
	//中等广告图
	public function selMid()
	{
		return $this->where('bid',3)->field('*')->select();
	}

	//大广告图
	public function selBigger()
	{
		return $this->where('bid',0)->field('*')->select();
	}

}