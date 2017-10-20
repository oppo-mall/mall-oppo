<?php
namespace app\index\model;
use think\Model;
use think\Db;


class User extends Model
{
	public function checkAll($name)
	{
		return Db::name('user')->where('username|email|tel','=',$name)->find();
	}
}