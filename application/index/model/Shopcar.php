<?php
namespace app\index\model;
use think\Model;
use think\Db;


class Shopcar extends Model
{
	public function selCar($uid)
	{
		return Db::view('shopcar','uid,gid,quantity,aid')
				->view('goods',['pname','old_price','price','size','color','inter','gid','pid'],'shopcar.gid=goods.gid')
				->view('img',['path_url','aid','pid'],'goods.pid=img.pid')
				->where('uid',$uid)
				->select();

	}
}