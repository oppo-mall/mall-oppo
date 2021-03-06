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
				->view('category',['cat,name,des'],'product.series=category.cat')
				->select();
	}
	
	//所有手机
	public function selAll()
	{
<<<<<<< HEAD
<<<<<<< HEAD
		return Db::view('product','pid,pname,series,description')
				->view('img',['pid','path_url','alt','title'],'product.pid=img.pid')
				->where('undercarriage',0)
=======
		return Db::view('product','pid,pname,series,description,price,old_price')
				->view('img',['pid','path_url','alt','title'],'product.pid=img.pid')
				->where('undercarriage',2)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
		return Db::view('product','pid,pname,series,description,price,old_price')
				->view('img',['pid','path_url','alt','title'],'product.pid=img.pid')
				->where('undercarriage',2)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
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
<<<<<<< HEAD
<<<<<<< HEAD
	
	//商品页上部分左图
	public function selSp($pid,$cid)
	{
	
	 return Db::view('product','pid')
					->view('imgd',['pid','path_url','alt','title','cid'],'product.pid=imgd.pid')
					->where('pid',$pid)
					->where('cid',$cid)
					->select();
		

	}
	
=======
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	//商品页信息【网络，颜色，容量
	public function selBuys($id)
	{
		return Db::name('goods')->field('pname,price,color,size,id,did')->where('did', $id)->select();
	}
	//商品页信息颜色
	public function selColor($id)
	{
		return Db::name('goods')->field('color')->where('did', $id)->distinct('color')->select();
	}
	//商品页信息容量
	public function selSize($id)
	{
		return Db::name('goods')->field('size')->where('did', $id)->distinct('size')->select();
	}
	//商品页信息容量
	public function selInter($id)
	{
		return Db::name('goods')->field('inter')->where('did', $id)->distinct('inter')->select();
	}
	//商品页小图
	public function selSp($id)
	{
		//return Db::name('product,oppo_imgd')->select();
        return Db::view('product','pid,pname,price')
				->view('imgd',['pid','path_url','alt','title'],'product.pid=imgd.pid')
				->where('pid',$id)
				->where('tid',1)
				->select();

	}
	//商品页大图
	public function selBp($id)
	{
        return Db::view('product','pid,pname,price')
				->view('imgd',['pid','path_url','alt','title'],'product.pid=imgd.pid')
				->where('pid',$id)
				->where('tid',2)
				->select();

	}
<<<<<<< HEAD
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
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
<<<<<<< HEAD
<<<<<<< HEAD
	public function selBig($pid)
	{
        return Db::view('product','pid')
				->view('imgp',['pid','path_url'],'product.pid=imgp.pid')
				->where('pid',$pid)
				->where('tid',1)
=======
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	public function selLarge($id)
	{
        return Db::view('product','pid')
				->view('imgd',['pid','path_url'],'product.pid=imgd.pid')
				->where('pid',$id)
				->where('tid',3)
<<<<<<< HEAD
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
				->select();

	}
	//商品页商品参数超大图
<<<<<<< HEAD
<<<<<<< HEAD
	public function selParam($pid)
	{
        return Db::view('product','pid')
				->view('imgp',['pid','path_url'],'product.pid=imgp.pid')
				->where('pid',$pid)
				->where('tid',2)
=======
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	public function selParam($id)
	{
        return Db::view('product','pid')
				->view('imgd',['pid','path_url'],'product.pid=imgd.pid')
				->where('pid',$id)
				->where('tid',4)
<<<<<<< HEAD
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
				->select();

	}
	//一级评论
<<<<<<< HEAD
<<<<<<< HEAD
	public function selComment($pid)
=======
	public function selComment($id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
	public function selComment($id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	{
        return Db::view('product','pid')
				->view('comment',['pid','uid','content','create_time','id','is_comment'],'product.pid=comment.pid')
				->view('user',['uid','icon'],'user.uid=comment.uid')
<<<<<<< HEAD
<<<<<<< HEAD
				->where('pid',$pid)
				->where('bid',0)
				->order('create_time desc')
=======
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
				->where('pid',$id)
				->where('bid',0)
				->order('create_time desc')
				//->paginate(5);
<<<<<<< HEAD
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
				->select();

	}
	//分页
<<<<<<< HEAD
<<<<<<< HEAD
	public function selPage($pid)
=======
	public function selPage($id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
	public function selPage($id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
	{
        return Db::view('product','pid')
				->view('comment',['pid','uid','content','create_time','id','is_comment'],'product.pid=comment.pid')
				->view('user',['uid','icon'],'user.uid=comment.uid')
<<<<<<< HEAD
<<<<<<< HEAD
				->where('pid',$pid)
=======
				->where('pid',$id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
=======
				->where('pid',$id)
>>>>>>> b7362c8cb898975fb7eed8292d4d5b6ce8aabba2
				->where('bid',0)
				->order('create_time desc')
				->paginate(5);
				

	}
}
