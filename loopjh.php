<?
include 'conn.php';
$bkk=bk;$navtis="(<font color=green><b>当前精华库</b></font>)";

$sql="select `cid` from `{$fkduo}zhuti` where (bk='$bk' and zd='0'and hs='0' and through='0' and jh='1')";
$query=mysql_query($sql);

$rows=mysql_num_rows($query); 
if ($rows==0){
include 'tis.php';
$tis= "对不起，当前版面暂时还没有精华贴";
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
$thedown="<a href=".urljh($bk,$now+1).">下一页</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=".urljh($bk,$now-1).">上一页</a>";
$thedown="<a href=".urljh($bk,$now+1).">下一页</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=".urljh($bk,$pages-1).">上一页</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}

function uuuw($mkktime){ //时间转换格式
$mkktime=date("y-m-d H:i",$mkktime);
return $mkktime;  
}

function uuuy($mkktime){ //时间转换格式
$mkktime=date("m-d H:i",$mkktime);
return $mkktime;
}

function uuuz($uuuz1,$uuuz2){ //列表简略分页
$uuuz=(int)($uuuz1/$uuuz2);
return $uuuz+1;
}

$listtop="listtop".$bk;//文件名

$sql="select * from `{$fkduo}zhuti` where (bk='$bk' and zd='0'and hs='0' and through='0' and jh='1') order by `lasttime` DESC limit $start,$liststep";
$query=mysql_query($sql);

$endtime=microtime(true);//输出运行时间
$total=$endtime-$starttime; 
$runtimes="<center>{$total} second(s)</center>";

include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('indexbk');

?>