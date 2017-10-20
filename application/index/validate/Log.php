<?php
namespace app\index\validate;
use think\Validate;


class Log extends Validate
{
    protected $rule = [
          'name'  =>  'require|max:15',
          'email' =>  'email',
          'number' =>
	]; 
}