<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use traits\model\SoftDelete;

class Imgp extends Model 
{
	public function add($tid,$pid,$path)
	{
		$this->tid = $tid;
		$this->path_url = $path;
		$this->pid = $pid;
		return $this->save();
	}
}