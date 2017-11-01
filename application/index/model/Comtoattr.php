<?php
namespace app\index\model;
use think\Model;
use think\Db;
/**
* 
*/
class Comtoattr extends Model
{
	function attrtocom()
	{
		return $this->hasOne('Commodity');
	}
	function comtoattr()
	{
		return $this->hasOne('attr','aid');
	}
}