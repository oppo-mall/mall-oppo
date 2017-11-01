<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

/**
*  
*/
class Commodity extends Model
{
	public function checkAll()
	{
		return $this->select();
	}
	public function savepro($pid,$pname,$attr,$money,$key)
	{
		return $this->data([
			'pid'=>$pid,
			'pname'=>$pname,
			'attrid'=>$attr,
			'money'=>$money,
			'stock'=>$key
		])->save();
	}
	public function attr()
	{
		return $this->belongstoMany('Attr','Comtoattr','aid','cid');
	}
	public function checkpname($cid)
	{
		return $this->where('cid',$cid)->select();
	}
}