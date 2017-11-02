<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Indent extends Model 
{
	public function Ingoods()
	{
		return $this->hasMany('Ingoods','oid');
	}

	public function checkAll()
	{
		//return Indent::field('oid,uid,count,total,create_time,status')->select();
		return $this->field('oid,uid,count,total,create_time,status')->select();
	}
	public function user()
	{
		return $this->hasOne('User','uid','uid');
	}

}