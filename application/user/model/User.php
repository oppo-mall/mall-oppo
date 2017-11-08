<?php
namespace app\user\model;
use think\Model;
use think\Db;
use think\Request;


class User extends Model
{
	public function checkAll($name)
	{
		return Db::name('user')->where('username|email|tel','=',$name)->find();
	}
<<<<<<< HEAD:application/user/model/User.php

=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2:application/user/model/User.php
	public function upip($uid)
	{
		$user = User::get($uid);
		$request = Request::instance();
		$user->logip = $request->ip();
		$user->save();
	} 
<<<<<<< HEAD:application/user/model/User.php
	public function insReg($data)
	{
		
		$this->allowField(true)->save($data);
		
	}
=======

	
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2:application/user/model/User.php
}