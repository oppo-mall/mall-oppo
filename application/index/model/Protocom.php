<?php
namespace app\index\model;
use think\Model;
use think\Db;


class Protocom extends Model
{
	public function checkcid($pid)
	{
		$arr = $this->where('pid',$pid)->select();
		return $arr['0'];
	}
}