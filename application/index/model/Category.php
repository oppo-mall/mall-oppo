<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Category extends Model
{	
	public function selCat()
	{
		return $this->field('name,cat,des')->select();
	}

}