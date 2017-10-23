<?php
namespace app\admin\model;
use think\Model;
use think\Db;


class Adv extends Model
{
		
	public function bo()
	{ 
		return Db::name('adv')->where('bid',1)->order('order')->select();
	}
	public function addpic()
	{
		
	}

}