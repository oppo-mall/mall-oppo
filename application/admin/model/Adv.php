<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Adv extends Model
{
	use SoftDelete;
    protected $deleteTime = 'delete_time';

	public function bo($bid)
	{ 

		return $this->where('bid',$bid)->order('order')->select();
	}
	public function addpic()
	{
		
	}

	public function delpicture($id)
	{
		return Adv::destroy($id);
	}
	public function uppic($info)
	{
		return $this->allowField(true)->save($info,['id' => $info['id']]);
	}
}