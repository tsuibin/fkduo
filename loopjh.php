<?
include 'conn.php';
$bkk=bk;$navtis="(<font color=green><b>��ǰ������</b></font>)";

$sql="select `cid` from `{$fkduo}zhuti` where (bk='$bk' and zd='0'and hs='0' and through='0' and jh='1')";
$query=mysql_query($sql);

$rows=mysql_num_rows($query); 
if ($rows==0){
include 'tis.php';
$tis= "�Բ��𣬵�ǰ������ʱ��û�о�����";
tis($tis);
exit();
}

function urljh($bk,$now=1){
$url="loopjh.php?bk={$bk}&now={$now}";
return $url;
}

if ($rows<$liststep) {
$pages=1;
}elseif($rows%$liststep==0)
{
$pages=(int)($rows/$liststep);
}elseif($rows%$liststep>0)
{
$pages=(int)($rows/$liststep)+1;
}

if ((int)($_GET['now'])==0){
$now=1;
}else{
$now=(int)($_GET['now']);
}

if ($now==1 and $pages==1)
{
$start=0;
}elseif ($now==1 and $pages>1)
{
$thedown="<a href=".urljh($bk,$now+1).">��һҳ</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=".urljh($bk,$now-1).">��һҳ</a>";
$thedown="<a href=".urljh($bk,$now+1).">��һҳ</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=".urljh($bk,$pages-1).">��һҳ</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}

function uuuw($mkktime){ //ʱ��ת����ʽ
$mkktime=date("y-m-d H:i",$mkktime);
return $mkktime;  
}

function uuuy($mkktime){ //ʱ��ת����ʽ
$mkktime=date("m-d H:i",$mkktime);
return $mkktime;
}

function uuuz($uuuz1,$uuuz2){ //�б���Է�ҳ
$uuuz=(int)($uuuz1/$uuuz2);
return $uuuz+1;
}

$listtop="listtop".$bk;//�ļ���

$sql="select * from `{$fkduo}zhuti` where (bk='$bk' and zd='0'and hs='0' and through='0' and jh='1') order by `lasttime` DESC limit $start,$liststep";
$query=mysql_query($sql);

$endtime=microtime(true);//�������ʱ��
$total=$endtime-$starttime; 
$runtimes="<center>{$total} second(s)</center>";

include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('indexbk');

?>