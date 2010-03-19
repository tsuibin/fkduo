<?
include 'conn.php';
include 'include/huhuhs.php';//分页计算
include 'tis.php';

if (($_SESSION[power]>3) or ((int)($_SESSION[power])==0))
{
$tis="你没有权限访问此页";
tis($tis);
exit;
}

if ($jilu==0){
$tis="对不起，记录不存在!";
tis($tis);
exit;
}


if ($huifu>0) {
$sql="select * FROM `{$fkduo}card` where (`cid`='$cid') order by lasttime limit $start,$contentstep";
$query=mysql_query($sql);
}

function uuuw($mkktime){
//$mkktime=(int)($mkktime);
$mkktime=date("y-m-d H:i:s",$mkktime);
return $mkktime;
}

function uuue($mkktime){
//$mkktime=(int)($mkktime);
$mkktime=date("Y-m-d",$mkktime);
return $mkktime;
}

$listtop="listtop".$bk;//文件名

include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('icbc21');


$sql90="update `zhuti` set `click`=`click`+1 where (`cid`='$cid')";
$query90=mysql_unbuffered_query($sql90); //
//require_once ('include/runtime.php');//输出运行时间
?>