<?php
namespace app\index\model;
use think\Model;
use think\Db;


class Commodity extends Model
{
	public function comtoattr()
	{
		return $this->hasMany('Comtoattr','cid','cid');
	}
	public function checkpid($cid)
	{
		return Db::name('Commodity')->where('cid',$cid)->value('pid');
	}
	public function attr()
	{
		return $this->belongstoMany('Attr','Comtoattr','aid','cid');
	}
	public function arraypid($pid)
	{
		return Db::name('Commodity')->where('pid',$pid)->select();
	}
	public function attrid()
	{
		
	}
}