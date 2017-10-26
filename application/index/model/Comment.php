<?php
namespace app\index\model;
use think\Model;
use think\Db;

class Comment extends Model
{
	//二级评论
	public function selCom()
	{
		
		return Db::name('comment')->field('id,content,bid,create_time')->where('bid', '<>',0)->order('create_time')->select();
	}

	//插入一级评论
	public function insCom($data)
	{
		$this->allowField(true)->save();
	}
	//插入追加评论
	public function insAddcom($data)
	{
		$this->allowField(true)->save();
	}
	//统计总共评论
	public function selCount()
	{
		 return Db::name('comment')->count('id');
	}
	//是否已经评论,当前用户的评论后自动生成的id
	public function selIscomment($uid)
	{
		 return Db::name('comment')->field('uid,id,is_comment,bid')->where('uid',$uid)->where('bid',0)->where('is_comment',1)->select();
	}

	public function selUid($uid)
	{
		return Db::name('comment')->field('uid')->where('uid',$uid)->find();
	}

}