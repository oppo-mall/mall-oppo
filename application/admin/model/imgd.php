<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Imgd extends Model 
{
	public function checkmax()
	{
		return $this->max('cid');
	}
}