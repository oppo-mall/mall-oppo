<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Category extends Model
{
	public function checkAll()
	{
		return $this->select();
	}
}