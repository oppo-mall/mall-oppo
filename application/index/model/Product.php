<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Product extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	
	//产品页手机型号
	public function selRes()
	{
		
		return Db::view('product','pid,pname,series,description')
				->view('img',['pid','path_url','alt','title'],'product.pid=img.pid')
				->select();
	}
	
	//所有手机
	public function selAll()
	{
		return Db::view('product','pid,pname,series,description')
				->view('img',['pid','path_url','alt','title'],'product.pid=img.pid')
				->where('undercarriage',0)
				->order('series')
				->select();
	}
	//手机配件
	public function selParts()
	{
		return Db::view('parts','aid,aname,price')
				->view('img',['pid','path_url','alt','title'],'parts.aid=img.aid')
				->where('is_present',null)
				->select();
	}
	
	//商品页上部分左图
	public function selSp($pid,$cid)
	{
	
	 return Db::view('product','pid')
					->view('imgd',['pid','path_url','alt','title','cid'],'product.pid=imgd.pid')
					->where('pid',$pid)
					->where('cid',$cid)
					->select();
		

	}
	
	//商品页名称
	public function selDe($id)
	{
        return Db::view('product','pid,pname,price,old_price,stock')
				->view('img',['pid','title'],'product.pid=img.pid')
				->where('pid',$id)
				->distinct(true)
				->select();

	}
	//商品页商品介绍超大图
	public function selBig($pid)
	{
        return Db::view('product','pid')
				->view('imgp',['pid','path_url'],'product.pid=imgp.pid')
				->where('pid',$pid)
				->where('tid',1)
				->select();

	}
	//商品页商品参数超大图
	public function selParam($pid)
	{
        return Db::view('product','pid')
				->view('imgp',['pid','path_url'],'product.pid=imgp.pid')
				->where('pid',$pid)
				->where('tid',2)
				->select();

	}
	//一级评论
	public function selComment($pid)
	{
        return Db::view('product','pid')
				->view('comment',['pid','uid','content','create_time','id','is_comment'],'product.pid=comment.pid')
				->view('user',['uid','icon'],'user.uid=comment.uid')
				->where('pid',$pid)
				->where('bid',0)
				->order('create_time desc')
				->select();

	}
	//分页
	public function selPage($pid)
	{
        return Db::view('product','pid')
				->view('comment',['pid','uid','content','create_time','id','is_comment'],'product.pid=comment.pid')
				->view('user',['uid','icon'],'user.uid=comment.uid')
				->where('pid',$pid)
				->where('bid',0)
				->order('create_time desc')
				->paginate(5);
				

	}
	
}
