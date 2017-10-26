<?php
namespace app\index\model;
use think\Model;
use think\Db;


class Adv extends Model
{
	//首页轮播图
	public function selBig()
	{
		return Db::name('adv')->where('bid',1)->field('*')->select();
	}
	//小广告图
	public function selSmall()
	{
		return Db::name('adv')->where('bid',2)->field('*')->select();
	}
	//中等广告图
	public function selMid()
	{
		return Db::name('adv')->where('bid',3)->field('*')->select();
	}

	//大广告图
	public function selBigger()
	{
		return Db::name('adv')->where('bid',0)->field('*')->select();
	}

}