<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
//载入ucpass类


require_once '../vendor/phpdemo/Ucpaas.class.php';
//require_once "../vendor/phpmail/Smtp.class.php";
// 应用公共文件
function phoneCode($to)
{	
	//初始化必填
	$options['accountsid']='c5027101c07f79fa0bfbf986cfb43acc';
	$options['token']='e70f2ef600f9982878aafcd7448b3f37';
	//初始化 $options必填
	$ucpass = new Ucpaas($options);
	//开发者账号信息查询默认为json或xml
	header("Content-Type:text/html;charset=utf-8");
	//短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	$appId = "230d4e7825064f18bc1b1aa0cd62ec1d";
	$templateId = "187172";
	$param= "7493";
	$ucpass->templateSMS($appId,$to,$templateId,$param);
	return $param;
}
	
function mailCode($smtpemailto,$mailtitle,$mailcontent)
	{
		
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.163.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "tjliyinjian@163.com";//SMTP服务器的用户邮箱
	$smtpemailto = $_POST['toemail'];//发送给谁
	$smtpuser = "tjliyinjian";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
	$smtppass = "ilikeyi29";//SMTP服务器的用户密码
	$mailtitle = $_POST['title'];//邮件主题
	$mailcontent = "<h1>".$_POST['content']."</h1>";//邮件内容
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = flied;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

	}



