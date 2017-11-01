<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use app\admin\Head;
use think\Request;
use app\admin\model\Category;
use app\admin\model\Product as pro;
use app\admin\model\commodity;
use app\admin\model\Attr;
use app\admin\model\imgp;
use app\admin\model\imgd;
use app\admin\model\Comtoattr;
/**
* 
*/
class Product extends Controller
{

	public function _initialize()
	{
		parent::_initialize();
        $this->head = new Head();
        $this->product = new Pro();
        $this->category = new category(); 
        $this->commodity = new commodity();
        $this->attr = new Attr();
        $this->imgp = new imgp();
        $this->imgd = new imgd();
        $this->comtoattr = new Comtoattr();

	}
	public function productlist()
	{
		$this->head->head();

		$post = Request::instance()->param();
		if (empty($post)) {
			$pidproduct = Commodity::all();
		} else {
			$pidproduct = Commodity::all('pid',$post['pid']);
		}

		
		foreach ($pidproduct as $key => $value) {
			$attr[] = $value->attr->toArray();
		}

		foreach ($attr as $key => $value) {
			foreach ($value as $k => $val) {
				$com = Commodity::get($val['pivot']['cid']);
				$pname = $com->pname;
				$stock = $com->stock;;
				$money = $com->money;
				$attr[$key][$k] = $val['type'].":" .$val['attrname'];
				$attr[$key]['pivot'] = $pname;
				$attr[$key]['stock'] = $stock;
				$attr[$key]['money'] = $money;
			}
		}
		// $this->assign('pidproduct',$pidproduct);
		$this->assign('attr',$attr);
		return $this->fetch();
	}
	public function productcategory()
	{
		$this->head->head();
		$series = Request::instance()->param();
		if(empty($series)){
			$series = 1;
		} 

		$pidproduct = $this->product->productshow($series);
		$this->assign('pidproduct',$pidproduct);
		return $this->fetch();
	}
	public function productcategoryadd()
	{
		$this->head->head();
		$this->view->engine->layout(false);
		return $this->fetch();
	}
	public function productadd()
	{
		$this->view->engine->layout(false);
		$option = $this->category->checkAll();
		$optionpid = $this->product->productshow();
		$attr = $this->attr->attrAll();
		$att =[];
		foreach ($attr as $key => $value) {
			$att[$value['type']][$value['aid']] = $value['attrname'];
		}
		$this->assign('attr',$att);
		$this->assign('optionid',$option);
		$this->assign('optionpid',$optionpid);
		return $this->fetch();
	}
	public function checkcate()
	{
		$res = $this->category->checkAll()->toArray();
		foreach ($res as $key => $value) {
			$n = $key+1;
			$return []= '{ id:1'.$n.', pId:1, name:' . $value['name'] . '}';
		}
		array_unshift($return,'{ id:1, pId:0, name:"oppo", open:true}');
		echo json_encode($return);
	}
	public function productbrand()
	{
		$this->head->head();
		// $com = $this->commodity->checkAll()->toArray();
		// foreach ($com as $key => $value) {
		// 	$pid = $value['pid'];
		// 	$pname[] =  $this->product->checkpid($pid)->toArray();
 	// 		$attrid = $value['attrid'];

		// }	dump($pname);
  // // foreach ($cid as $key => $value) {
  //  $res[]= $this->commod->selCommod($value)->toArray();

  // }
  // //二维数组
  // foreach ($res as $k => $val) {
  //  $res[$k] = $val['0'];
  // }
  // foreach ($res as $keys => $values) {
  //  $attrid[$keys] = $values['attrid'];
  // }
  // //dump($attrid);
  // $attr=[];
  // foreach ($attrid as $key => $value) {
  //  $res= trim($value,'{');
  //  $res = trim($res,'}');
  //  $res = str_replace(':', "", $res);
  //  $res = explode(",", $res);
   
  //  foreach ($res as $k => $val) {
  //   $attr[]= $this->attr->findattr($k,$val)->toArray();  
  //  }
  // }

  // foreach ($attr as $key => $value) {
  //  $attr1[$key] = $value[0]['attrname'];
  //  $kattr[] = $value[0]['aid'];
  // }
  // //$attr = implode(',',$attrid);
  // $att =array_chunk($attr1, 3,true);
  // $ktt = array_chunk($kattr, 3);
  // foreach ($att as $key => $value) {
  //  $end[] = array_combine($ktt[$key], $att[$key]);
  // }
		$data = $this->category->checkAll();
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function optionid()
	{
		$id = Request::instance()->param();
		$series = $this->product->option($id['id'])->toArray();
		echo json_encode($series);
	}
	public function addpic()
    {
        $file = request()->file();
        //移动到框架应用根目录/public/uploads/ 目录下
        $info = $file['file']->move('uploads'); 
        if($info){
             $path ='/' . $info->getPathname();
             $this->picPath = $path;
             echo $path;
        }else{
            echo $file->getError();
        }              
    }
    public function productall()
    {
    	$res=Request::instance()->param();
    	dump($res);

    }

    public function submitfile()
    {
    	$data = Request::instance()->param();
    	$pname = $data['name'];
    	$alt = $data['title'];
    	$price = $data['price'];
    	$key = $data['key'];
    	$id = $data['classify'];
    	$pid = intval($data['series']);

    	$list =$data['list'];
   		$attr = implode(',',$list);
    	$res = $this->commodity->savepro($pid,$pname,$attr,$price,$key);
		$cid = $this->commodity->cid;
    	$imgd = $data['img'];	
    	$img = model('imgd');


    	foreach ($imgd as $key => $value) {
    		$li[] = ['pid'=>$pid,'cid'=>$cid,'path_url'=>$value];
    	}
    	$img->saveAll($li);


    	foreach ($list as $key => $value) {
    		$attrlist[] = ['pid'=>$pid,'cid'=>$cid,'aid'=>$value];
    	}
    	$attr = model('comtoattr');
    	$attr->saveAll($attrlist);
    }
    public function proadd()
    {
    	$this->view->engine->layout(false);
       	$option = $this->category->checkAll();
    	$this->assign('optionid',$option);
    	return $this->fetch();
    }
    public function doaddproduct()
    {

    	$res = Request::instance()->param();

 		$r = $this->product->addproduct($res);
 			$img = $res['img'];
    	$i = 1;
    	foreach ($img as $key => $value) {
    		$i++;
    		if ($i>11) {
    			$imgp = model('imgp');
    			$imgp->data([
    				'tid' =>2,
    				'path_url'=>$value,
    				'pid'=> $r
    			])->save();
    		} else {
	    			$imgp = model('imgp');
	    			$imgp->data([
	    				'tid' =>1,
	    				'path_url'=>$value,
	    				'pid'=> $r
	    			])->save();
    		}
    	}

    }

}