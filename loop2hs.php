<?
include 'conn.php';
include 'include/huhuhs.php';//��ҳ����
include 'tis.php';

if (($_SESSION[power]>3) or ((int)($_SESSION[power])==0))
{
$tis="��û��Ȩ�޷��ʴ�ҳ";
tis($tis);
exit;
}

if ($jilu==0){
$tis="�Բ��𣬼�¼������!";
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

$listtop="listtop".$bk;//�ļ���

include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('icbc21');


$sql90="update `zhuti` set `click`=`click`+1 where (`cid`='$cid')";
$query90=mysql_unbuffered_query($sql90); //
//require_once ('include/runtime.php');//�������ʱ��
?>