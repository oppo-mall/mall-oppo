<?php
namespace app\index\model;
use think\Model;
use think\Db;
use think\Request;


class User extends Model
{
	public function checkAll($name)
	{
		return Db::name('user')->where('username|email|tel','=',$name)->find();
	}
	public function upip($uid)
	{
		$user = User::get($uid);
		$request = Request::instance();
		$user->logip = $request->ip();
		$user->save();
	} 
}