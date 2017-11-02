<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;


class Ingoods extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function indent()
	{
		return $this->belongTo('indent');
	}
}