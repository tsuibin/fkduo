<?php
session_start();
if ($yanc!=1){
	$time_curr = time();
	$time_pre = (int)($_SESSION['time_pre']);
	if($time_curr-$time_pre<1){ 
		sleep(1); 
	}else{
		$_SESSION['time_pre']=$time_curr;
	}
}

include 'config/database.php';

$starttime=microtime(true);//��������ʱ����ʼֵ
$conn = @ mysql_connect($db_host, $db_username, $db_password) or die("���ݿ����ô���");
mysql_select_db($db_name, $conn);
mysql_query("set names 'utf8'"); //ʹ��utf8���ı���;
date_default_timezone_set('PRC'); //��Ϊ����ʱ

include 'config/fkduo.php';

$bk=(int)($_GET['bk']);  //����ֵ
$cid=(int)($_GET['cid']);  //����ֵ

$holdtime=$holdtime*60;

if ($bk==0){
	$bk=$zhuid;
}

if (isset($_SESSION['logname'])){//�ж�SESSION�Ƿ����
	if (($time_curr-(int)($_SESSION['holdtimes']))>$holdtime){
		session_destroy();
	}else{
		$_SESSION['holdtimes']=time();
	}
}

include 'config/ads.php';

function url2($bk,$cid,$now=1){
	global $sys_rewrite;
	if ($sys_rewrite==1){
		$url="loop2,{$bk},{$cid},{$now}.html";
	}else{
		$url="loop2.php?bk={$bk}&cid={$cid}&now={$now}";
	}
	return $url;
}



function url($bk,$now=1){
	global $sys_rewrite;
	if ($sys_rewrite==1){
		$url="loop,{$bk},{$now}.html";
	}else{
		$url="loop.php?bk={$bk}&now={$now}";
	}
	return $url;
}

function ruku($rukuu){
	$rukuu=trim($rukuu);
	$rukuu=addslashes($rukuu);
	return $rukuu;
}

?>