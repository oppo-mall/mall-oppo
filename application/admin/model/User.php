<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;


class User extends Model
{
	use SoftDelete;
	protected $deleteTime= 'delete_time';
	public function checkAll($id)
	{
		return Db::name('user')->where('uid',$id)->find();
	}
	public function checkId($id)
	{	

		$userlist = User::get($id);
		return $userlist;

	}
	public function getUdertypeAttr($value)
	{
		$udertype = ['0'=>'买家','1'=>'管理员','2'=>'卖家'];
		return $udertype[$value];
	}
	public function checkuser()
	{
		return $this->select();
	}
	public function islog($data)
	{
		return $this->save(['is_log'=>$data['islog']],['uid'=>$data['uid']]);
	}
	public function usermodify($data)
	{
		return $this->save([
				'nickname'=>$data['username'],
				'email'=>$data['email'],
				'tel'=>$data['mobile'],
		],['uid'=>$data['uid']]);;
	}
	public function passchange($uid,$pwd)
	{
		return $this->save(['password'=>$pwd],['uid'=>$uid]);
	}
	public function ruandeluser($uid)
	{
		return User::destroy($uid);
	}
	public function checkdelete()
	{
		return User::onlyTrashed()->select();
	}
	public function replay($uid)
	{
		return $this->save([
      			'delete_time'  => null,
 				 ],['uid' => $uid]);
	}
	public function readydel($uid)
	{
		return User::destroy($uid,true);
	}
}