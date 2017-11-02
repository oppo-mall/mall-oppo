<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Img extends Model 
{
	public function add($path,$pid)
	{
		$this->path_url = $path;
		$this->pid = $pid;
		return $this->save();
	}
}