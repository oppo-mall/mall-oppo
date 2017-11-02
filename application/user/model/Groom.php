<?php
namespace app\user\model;
use think\Model;
use think\Db;


class Groom extends Model
{
	//推荐机型
	public function selGroom()
	{
		return Db::name('groom')->where('groom',1)->field('groom,url,pname')->select();
	}

}