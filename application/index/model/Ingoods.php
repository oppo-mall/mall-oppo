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
		return $this->belongsTo('indent');
	}

	public function picture($uid)
	{

		return Db::view('ingoods','cid')
			->view('imgd',['cid','path_url'],'ingoods.cid=imgd.cid')
			->where('uid',$uid)
			//->distinct(true)
			->select();
	}
}