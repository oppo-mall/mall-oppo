<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
/**
* 
*/
class Comtoattr extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	function attrtocom()
	{
		return $this->hasOne('Commodity');
	}
	function comtoattr()
	{
		return $this->hasOne('attr','aid');
	}
	public function color($aid,$pid)
	{
		return Db::view('comtoattr','aid,cid,pid')
			->view('attr',['attrname'],"attr.aid=comtoattr.aid")
			->view('imgd',['cid','path_url','pid','cid'],'comtoattr.cid=imgd.cid')
			->where('aid',$aid)
			->where('pid',$pid)
			->select();
	}
}