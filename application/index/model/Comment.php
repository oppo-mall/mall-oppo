<?php
namespace app\index\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;
class Comment extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
	//二级评论
	public function selCom($pid)
	{
		
		return $this->field('id,content,bid,create_time')->where('bid','<>',0)->select();
		
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
		 return $this->count('id');
	}
	//是否已经评论,当前用户的评论后自动生成的id
	public function selIscomment($uid)
	{
		 return $this->field('uid,id,is_comment,bid')->where('uid',$uid)->where('bid',0)->where('is_comment',1)->select();
	}

	public function selUid($uid)
	{
		return $this->field('uid')->where('uid',$uid)->find();
	}

}