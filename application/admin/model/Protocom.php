<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Protocom extends Model 
{
	public function addpro($pid,$cid)
	{
		return $this->data(['pid'=>$pid,'cid'=>$cid])->save();
	}
}