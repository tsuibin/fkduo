<?
include 'conn.php';
include 'check.php';

if (!isset($_GET['action'])){
$ppallow=$_SESSION[ppallow];
$from=ruku($_GET['from']);
$to=ruku($_GET['to']);

$sql="select * FROM `{$fkduo}user` where (`logname`='$from') limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);
$aa=$row[nickname]."aa";

$sql="select * FROM `{$fkduo}user` where (`logname`='$to') limit 1";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu==0){
$tis="�Ҳ�������û������޷�����!";
tis($tis);
exit;
}
$row=mysql_fetch_array($query);
$bb=$row[nickname];
$url=$HTTP_SERVER_VARS["HTTP_REFERER"]; 
include 'xingTemplate.php';
$xingTemplate->display('prize');
exit;
}



if ($_GET['action']==prizeok){
$how=(int)($_POST['awardValue']);
$lc=(int)($_GET['lc']);
$why=ruku($_POST['why']);

if ($how>$_SESSION[ppallow]){
$tis= "����ʧ�ܣ���Ŀ��÷������㣡";
tis($tis);
exit();
}

if ($_SESSION[logname]==$_POST['to']){
$tis= "�ɲ����Բ�Ҫ���Լ����֣����ᣡ";
tis($tis);
exit();
}

if ($how<=$_SESSION[ppallow] and $how>0){
$sql="update `{$fkduo}user` set `ppallow`=`ppallow`-$how where (`logname`='$_SESSION[logname]') limit 1";
$query=mysql_query($sql);//�����û���������

$to=addslashes($_POST['to']);
$sql="update `{$fkduo}user` set `pp`=`pp`+$how where (`logname`='$to') limit 1";
$query=mysql_query($sql);//�����û���������

switch ($_GET['mod']){
case lz:
$sql="update `{$fkduo}zhuti` set `prizepp`=`prizepp`+$how where (`cid`='$cid') limit 1";
$query=mysql_query($sql);//�����û���������
break;
case huifu:
$sql="update `{$fkduo}card` set `prizepp`=`prizepp`+$how where (`cid`='$cid' and `lc`='$lc') limit 1";
$query=mysql_query($sql);//�����û���������
break;
default:
break;
}

$sql9="select * FROM `{$fkduo}user` where (`logname`='$_SESSION[logname]') limit 1";
$query9=mysql_query($sql9);
$row9=mysql_fetch_array($query9);
$nickname=$row9[nickname];

$time=mktime();
$sql="INSERT INTO `{$fkduo}prizeinfo` (`bk`,`cid`,`lc`,`logname`,`nickname`,`why`,`how`,`time`) VALUES ('$bk','$cid','$lc','$_SESSION[logname]','$nickname','$why','$how','$time')";
$query=mysql_query($sql);//

$_SESSION[ppallow]=$_SESSION[ppallow]-$how;
$eeee="prize.php?action=prizeinfo&mod=".$_GET['mod']."&bk=".$bk."&cid=".$cid."&lc=".$lc;
header ("location: $eeee"); 
}else
{
$tis= "���ķ�������!";
tis($tis);
}
exit;}






if ($_GET['action']==prizeinfo){
$lc=(int)($_GET['lc']);
switch ($_GET['mod']){
case lz:
$sql2="select `prizepp` FROM `{$fkduo}zhuti` where (`cid`='$cid') limit 1";
$query2=mysql_query($sql2);
$row2=mysql_fetch_array($query2);

$sql="select * FROM `{$fkduo}prizeinfo` where (`cid`='$cid' and `lc`='0') order by `time` limit 200";
$query=mysql_query($sql);

break;
case huifu:
$sql2="select `prizepp` FROM `{$fkduo}card` where (`cid`='$cid' and `lc`='$lc') limit 1";
$query2=mysql_query($sql2);
$row2=mysql_fetch_array($query2);

$sql="select * FROM `{$fkduo}prizeinfo` where (`cid`='$cid' and `lc`='$lc') order by `time` limit 200";
$query=mysql_query($sql);
break;
default:
break;
}
include 'xingTemplate.php';
$xingTemplate->display('prizeinfo');
exit;}


?>