<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\model\User; 
use app\admin\model\Adv;
use think\Request;
use app\admin\Head;
class Index extends Controller
{
	protected $user;
    protected $adv;
    protected $userinfo;
    protected $picPath;
    protected $manypath=[];

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User();
        $this->adv = new Adv();
        $this->head = new Head();
        
	}
    // protected function head()
    // {	
    // 	if(!Session::has('uid','admin')){
    // 		//返回重新登录
    // 		$this->redirect('Index/index/index');

    // 	};
    // 	$uid = Session::get('uid','admin');
    // 	$userobj = $this->user->checkId($uid);
    // 	$udertype = $userobj->udertype;
    // 	$update_time = $userobj->update_time;

    // 	$userinfo = $this->user->checkAll($uid);
    //     $userinfo['udertype'] = $udertype;
    //     $userinfo['update_time'] = $update_time;
    //     $this->userinfo = $userinfo;

    // 	foreach ($userinfo as $key => $value) {
    // 	$this->assign($key,$value);
    // 	}
    // }

    public function logout()
    {
        if (Session::has('uid')) {
            Session::delete('uid','admin'); 
        }
        $this->redirect('Index/index/index');
    }
    public function index(){
        $this->head->head();
        $info = array(
        '操作系统'=>PHP_OS,
        '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
        'PHP运行方式'=>php_sapi_name(),
        'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
        '上传附件限制'=>ini_get('upload_max_filesize'),
        '执行时间限制'=>ini_get('max_execution_time').'秒',
        '服务器时间'=>date("Y年n月j日 H:i:s"),
        '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
        '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
        '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
        'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
        'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
        'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        $this->assign('info',$info);
        return $this->fetch();
    }

    public function advpicturelist()
    {
        $this->head->head();
        $info = Request::instance()->param();
        $bid = $info['bid'];
        $list = $this->adv->bo($bid);
        foreach ($list as $key => $value) {
            if ( !is_null(json_decode($value['path']))) {
                $list[$key]['path'] = json_decode($value['path'])->url1;

            }
        }
        $this->assign('bid',$bid);
        $this->assign('list',$list);
                return $this->fetch();    
    }

    //上传图片用
    public function addpic()
    {
        $file = $this->request->file();
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file['file']->move('uploads'); 
        if($info){
             $path ='/' . $info->getPathname();
             $this->picPath = $path;
             echo $path;
        }else{
            echo $file->getError();
        }              
    }

    public function pictureshow()
    {
        $this->head();
        $list = $this->adv->bo();
        $this->assign('list',$list);
        $this->view->engine->layout(false);
        return $this->fetch();
    }
    public function pictureadd()
    {
         $this->view->engine->layout(false);
         $param =  Request::instance()->param();
         //dump($param);
         $this->assign('param',$param);

        return $this->fetch();
    }
    public function addbo()
    {   

        $picinfo = Request::instance()->param();
        $this->addpic();
    }
    public function add()
    {
        $this->view->engine->layout(false);
        $info = Request::instance()->param(); 

        if (array_key_exists(1,$info['path'])) {
            $info['path'] = json_decode($info['path']);
        } else {
            $info['path'] = $info['path']['0'];
        }
        dump($info);
        // $id = Adv::get($info['id']); 
        // $bid = $id->bid;
        $res = $this->adv->uppic($info);

        //$this->redirect('admin/index/advpicturelist/bid/'.$bid);


        $id = Adv::get($info['id']); 
        $bid = $id->bid;
        $res = $this->adv->uppic($info);
        $this->redirect('admin/index/advpicturelist/bid/'.$bid);

    } 
    public function delpic()
    {
        $data = Request::instance()->param();
        dump($data);
        $id=$data['id'];
        $del = $this->adv->delpicture($id);
        dump($del);
        if ($del) {
            echo json_encode(['status'=>'0']);
        } else {
            echo json_encode(['status'=>'1']);
        }
    }

}
