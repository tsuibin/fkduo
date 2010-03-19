<?
include 'conn.php';
include 'tis.php';

if (($_SESSION[power]>3) or ($_SESSION[power]<1)){
echo "<font color=red>管理重地，闲人勿进！</font>";
exit;
}

if ($_SESSION[power]==3){//版主和管理员区分
$query=mysql_query("select * from {$fkduo}bkmaster where `bkid`='$bk' and `uid`='$_SESSION[logname]'");
$jilu=mysql_num_rows($query);
if ($jilu==0){
$tis="操作失败,你不是这个版的版主!<br>如果您是管理员，请先升为管理员!";
tis($tis);
exit;
}}


function tj($cid,$bk,$fkduo) { //推荐设置与解除功能
$tj=(int)($_GET['tj']);
if ($tj=='1'){
$sql="update `{$fkduo}zhuti` set `tj`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //

$eee="make.php?action=right";
header ("location: $eee"); 
}else
{
$sql="update `{$fkduo}zhuti` set `tj`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
$eee="make.php?action=right";
header ("location: $eee"); 
}
}


function zd($cid,$bk,$fkduo) { //置顶设置与解除功能

$zd=(int)($_GET['zd']);
if ($zd=='1'){
$sql="update `{$fkduo}zhuti` set `zd`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
$eee="make.php?action=listtop&bk=".$bk;
header ("location: $eee"); 
}else
{
$sql="update `{$fkduo}zhuti` set `zd`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //

$eee="make.php?action=listtop&bk=".$bk;
header ("location: $eee"); 
}
}

function jh($cid,$fkduo) { //精华设置与解除功能
$jh=(int)($_GET['jh']);
if ($jh=='1'){
$sql="update `{$fkduo}zhuti` set `jh`='1' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "<br>精华成功<br><br>";
echo "<a href=process.php?action=jh&jh=2&cid=".$cid.">点此解除精华</a>";
}else
{
$sql="update `{$fkduo}zhuti` set `jh`='0' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "解除精华成功";
}
exit;
}

function lock($cid,$fkduo) { //锁定设置与解除功能
$lock=(int)($_GET['lock']);
if ($lock=='1'){
$sql="update `{$fkduo}zhuti` set `lock`='1' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "<br>锁定成功<br><br>";
echo "<a href=process.php?action=lock&lock=2&cid=".$cid.">点此解除锁定</a>";

}else
{
$sql="update `{$fkduo}zhuti` set `lock`='0' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "解除锁定成功";
}
}

function pblz($cid,$bk,$fkduo) { //主贴屏蔽设置与解除功能
$pb=(int)($_GET['pb']);
if ($pb=='1'){
$sql="update `{$fkduo}zhuti` set `pb`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "<br>屏蔽成功<br><br>";
echo "<a href=process.php?action=pblz&pb=2&cid=".$cid.">点此解除屏蔽</a>";
}else
{
$sql="update `{$fkduo}zhuti` set `pb`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "解除屏蔽成功";
}
}

function pbhuifu($cid,$bk,$fkduo) { //回贴屏蔽设置与解除功能
$pb=(int)($_GET['pb']);
$lc=(int)($_GET['lc']);
if ($pb=='1'){
$sql="update `{$fkduo}card` set `pb`='1' where (`cid`='$cid' and `lc`='$lc' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "屏蔽成功";
}else
{
$sql="update `{$fkduo}card` set `pb`='0' where (`cid`='$cid' and `lc`='$lc' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "解除屏蔽成功";
}
}


function hslz($cid,$fkduo) { //主题回收站设置与解除功能
$huifu=(int)($_GET['huifu']);
mysql_query("update `{$fkduo}zhuti` set `hs`='1' where (`cid`='$cid') limit 1"); //回收主贴
if ($huifu>0){ mysql_query("update `{$fkduo}card` set `hs`='1' where (`cid`='$cid')");}//回收回贴
echo "贴子成功移入回收站";
}


function delhuifu($cid,$fkduo) { //回复删除
$lc=(int)($_GET['lc']);
$query=mysql_query("select * FROM `{$fkduo}card` where (`cid`='$cid' and `lc`='$lc') limit 1");
$row=mysql_fetch_array($query);
if ($row[pic]!="0"){ unlink($row[pic]); }//删除附件

mysql_query("DELETE FROM `{$fkduo}card` WHERE (`cid`='$cid' and `lc`='$lc') limit 1") or die ("删除出错了!");
mysql_query("update `{$fkduo}zhuti` set `huifu`=`huifu`-1 where (`cid`='$cid') limit 1"); //更新主题回复数

echo "贴子成功删除或移入回收站";
}


function highlight($cid,$mod,$fkduo){//高亮
if ($mod==1){
mysql_query("update `{$fkduo}zhuti` set `highlight`='1' where `cid`='$cid' limit 1") or die ("出错了"); //高亮
echo "<br >高亮成功了!<br ><br >";
echo "<a href=process.php?action=highlight&mod=2&cid=".$cid.">点此解除高亮</a>";
}else
{
mysql_query("update `{$fkduo}zhuti` set `highlight`='0' where `cid`='$cid' limit 1") or die ("出错了"); //撤消高亮
echo "取消高亮成功!";
}
exit;
}



switch($_GET['action'])
{
case 'tj':
       tj($cid,$bk,$fkduo);break;
case 'zd':
       zd($cid,$bk,$fkduo);break;
case 'jh':
       jh($cid,$fkduo);break;
case 'hslz':
       hslz($cid,$fkduo);break;
case 'lock':
       lock($cid,$fkduo);break;
case 'pblz':
       pblz($cid,$bk,$fkduo);break;
case 'pbhuifu':
       pbhuifu($cid,$bk,$fkduo);break;
case 'delhuifu':
       delhuifu($cid,$fkduo);break;	   
case 'highlight':
       highlight($cid,$_GET['mod'],$fkduo);break;
default:
       echo "无操作！"; // 
}
?>