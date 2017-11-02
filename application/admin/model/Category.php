<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Category extends Model
{
	public function checkAll()
	{
		return $this->where('id',1)->select();
	}
	public function check()
	{
		return $this->select();
	}
	public function add($res)
	{
		return $this->allowField(true)->save();
	}
}