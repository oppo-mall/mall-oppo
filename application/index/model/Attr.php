<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Attr extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function findattr($k,$val)
	{
		return $this->field('attrname,aid')->where('type',$k)->where('aid',$val)->select();
		
	}
}