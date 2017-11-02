<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\index\model\Shopaddr;

class Address extends Controller
{
	
	public function _initialize()
	{
		parent::_initialize();
		$this->addr = new Shopaddr($_POST);
	}

	public function address()
	{
		$data = Request::instance()->param();
		$this->addr->saveAddr($data);

		return $data;
	}
}