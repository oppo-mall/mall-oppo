<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Shopaddr extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	public function saveAddr($data)
	{
		$this->allowField(true)->save($data);
	}

	public function selAddr($uid)
	{

		return $this->where('uid',$uid)->select();
	}
}