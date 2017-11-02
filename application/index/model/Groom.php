<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Groom extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	//推荐机型
	public function selGroom()
	{
		return $this->where('groom',1)->field('groom,url,pname')->select();
	}

}