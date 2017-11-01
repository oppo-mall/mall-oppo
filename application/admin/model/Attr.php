<?php
namespace app\admin\model;
use think\Model;
use think\Db;

class Attr extends Model 
{
	public function attrAll()
	{
		return $this->select()->toArray();
	}
	public function getTypeAttr($value)
	{
		$type = [0=>'颜色',1=>'网络类型',2=>'配置',3=>'内存'];
		return $type[$value];
	}
	public function attrsel($v)
	{
		return $this->where('aid',$v)->field('attrname')->select();
	}
}