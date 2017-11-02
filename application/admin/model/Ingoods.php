<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Ingoods extends Model 
{
	public function Indent()
	{
		return $this->belongsTo('Indent');
	}
}