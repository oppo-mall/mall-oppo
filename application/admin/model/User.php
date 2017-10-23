<?php
namespace app\admin\model;
use think\Model;
use think\Db;


class User extends Model
{
	public function checkAll($id)
	{
		return Db::name('user')->where('uid',$id)->find();
	}
	public function checkId($id)
	{	

		$userlist = User::get($id);
		return $userlist;

	}
	public function getUdertypeAttr($value)
	{
		$udertype = ['0'=>'买家','1'=>'管理员','2'=>'卖家'];
		return $udertype[$value];
	}
}