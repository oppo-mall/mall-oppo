<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

/**
* 
*/
class Product extends Model 
{
	
	public function productshow()
	{
		return $this->select();
	}
	public function checkpid($pid)
	{
		return $this->field('pname')->where('pid',$pid)->select();
	}
	public function option($id)
	{
		return $this->field('pname,pid')->where('series',$id)->select();
	}
	public function addproduct($res)
	{
		 $this->allowField(true)->save($res);
		 return $this->pid;
	}

}	