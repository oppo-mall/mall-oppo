<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\model\User; 
use app\admin\model\Indent;
use app\admin\model\ingoods;
use think\Request;
use app\admin\Head;
class Order extends Controller
{
	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
        $this->head = new Head();  
        $this->indent = new Indent();
	}

	public function ordlist()
	{
		$this->head->head();
		$list = $this->indent->checkAll();
		//dump($list);
		foreach ($list as $key => $value) {
			//dump($value->ingoods->toArray());
			$userinfo = $value->user->toArray();
			if (!empty($userinfo['username'])) {
				$name = $userinfo['username'];
				$value->uid=$name;
			} elseif (!empty($userinfo['email'])) {
				$name = $userinfo['email'];
				$value->uid=$name;
			} elseif (!empty($userinfo['tel'])) {
				$name = $userinfo['tel'];
				$value->uid=$name;
			}
		}
		$list = $list->toArray();
		$count = Indent::count();

		$this->assign('list',$list);
		$this->assign('count',$count);
		return $this->fetch();
	}
}