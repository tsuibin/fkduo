<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body class="wenzi">
<script language='javascript'>function checkall(form) { for(var i=0;i<form.elements.length; i++) { var e = form.elements[i]; if (e.name != 'chkall' && e.disabled != true) { e.checked = form.chkall.checked; } }}</script>

<?

include 'conn.php';

if ($_SESSION[power]!=1){
echo "<font color=red>管理重地，闲人勿进！</font>";
exit;
}


if (empty($_POST['mod'])){
$mod=(int)($_GET['mod']);
}else
{
$mod=(int)($_POST['mod']);
}

if (empty($_POST['logname'])){
$logname=ruku($_GET['logname']);
}else
{
$logname=ruku($_POST['logname']);
}

function uuuw($mkktime){ //时间转换格式
$mkktime=date("Y-m-d H:i",$mkktime);
return $mkktime;  
}

//$liststep=15;

if (empty($_GET['step'])){
?>

<form id="form1" name="form1" method="post" action="fkduo_delusercard.php?step=2">
  <table width="648" height="105" border="1">
    <tr>
      <td height="44" colspan="4">批量删除用户帖子</td>
    </tr>
    <tr>
      <td>用户名</td>
      <td><label>
        <input type="text" name="logname" />
      </label></td>
      <td><input name="mod" type="radio" value="1" checked="checked" />
主题
  <input type="radio" name="mod" value="2" />
回复</td>
      <td><label>
        <input type="submit" name="Submit2" value=" 列 出 帖 子" />
      </label></td>
    </tr>
  </table>
</form>

<?
exit;
}elseif ($_GET['step']==2 and $mod==1)
{
$sql="select * from {$fkduo}zhuti where `firstlogname`='$logname' and `hs`='0'";
$query=mysql_query($sql);
$rows=mysql_num_rows($query);
if ($rows<1){
echo "<font color=red>找不到此用户名或当前此用户没有帖子记录</font>";
exit;
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
$thedown="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=".($now+1).">下一页</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=".($now-1).">上一页</a>";
$thedown="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=".($now+1).">下一页</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=".($pages-1).">上一页</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}

$thefirst="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=1>首页</a>";
if ($now==1){$thefirst="";}
$thelast="<a href=fkduo_delusercard.php?step=2&mod=1&logname=".$logname."&now=".$pages.">尾页</a>";
if ($now==$pages){$thelast="";}
$sql="select * from {$fkduo}zhuti where `firstlogname`='$logname' and `hs`='0' ORDER by `cid` DESC limit $start,$liststep";
$query=mysql_query($sql);
?>

<form id="form" name="form" method="post" action="fkduo_delusercard.php?step=3&mod=1&logname=<? echo $logname ?>&now=<? echo $now ?>">
<table width="567" height="148" border="1">
  <tr>
    <td colspan="2" bgcolor="#99CC66">批量删除用户主贴</td>
  </tr>
  <tr>
    <td width="51">删除</td>
    <td width="372">标题</td>
  </tr>
 
  <? while ($row=mysql_fetch_array($query)){ ?>
  <tr>
    <td>
      <input name="delzhuti[]" type="checkbox" id="delzhuti[]" value="<? echo $row[cid] ?>" />
    </td>
    <td><a href="../loop2.php?bk=<? echo $row[bk] ?>&cid=<? echo $row[cid] ?>" target="_blank"><? echo $row[title] ?></td>
  </tr>
  <? } ?>
  

  
  <tr>
    <td colspan="2">
	全选:<input type="checkbox" id="selectAll" name='chkall' onclick="checkall(this.form)"/>
	  总共<? echo $pages ?>页，当前第<? echo $now ?>页&nbsp;
	  <? echo $thefirst ?>&nbsp;<? echo $theup ?> &nbsp;<? echo $thedown ?>&nbsp;<? echo $thelast ?>&nbsp;<br /><br />
	<center>
      <input type="submit" name="Submit" value="删 除" />
    </center></td>
    </tr>
</table>        
</form>

<?
}elseif ($_GET['step']==2 and $mod==2){

$sql="select * from {$fkduo}card where `lastlogname`='$logname' and `hs`='0'";
$query=mysql_query($sql);
$rows=mysql_num_rows($query);
if ($rows<1){
echo "<font color=red>找不到此用户名或当前此用户没有帖子记录</font>";
exit;
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
$thedown="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=".($now+1).">下一页</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=".($now-1).">上一页</a>";
$thedown="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=".($now+1).">下一页</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=".($pages-1).">上一页</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}

$thefirst="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=1>首页</a>";
$thelast="<a href=fkduo_delusercard.php?step=2&mod=2&logname=".$logname."&now=".$pages.">尾页</a>";
if ($now==1){$thefirst="";}
if ($now==$pages){$thelast="";}

$sql="select * from {$fkduo}card where `lastlogname`='$logname' and `hs`='0' ORDER by `id` DESC limit $start,$liststep";
$query=mysql_query($sql);



?>



<form id="form" name="form" method="post" action="fkduo_delusercard.php?step=3&mod=2&logname=<? echo $logname ?>&now=<? echo $now ?>">
<table width="567" height="148" border="1">
  <tr>
    <td colspan="2" bgcolor="#99CC66">批量删除用户回贴</td>
  </tr>
  <tr>
    <td width="51">删除</td>
    <td width="372">内容</td>
  </tr>
 
  <? while ($row=mysql_fetch_array($query)){ ?>
  <tr>
    <td>
      <input name="delhuifu[]" type="checkbox" id="delhuifu[]" value="<? echo $row[id].",".$row[cid] ?>" />
    </td>
    <td>
	<? echo $row[lc] ?>楼:
	<a href="../loop2.php?bk=<? echo $row[bk] ?>&cid=<? echo $row[cid] ?>#pid<? echo $row[lc] ?>" target="_blank">
	<? echo $row[content] ?>
	<? if ($row[pic]!=0){echo "<br /><img src=".$row[pic]." /><br />";} ?>
	
	</td>
  </tr>
  <? } ?>
  

  
  <tr>
    <td colspan="2">
	  全选:<input type="checkbox" id="selectAll" name='chkall' onclick="checkall(this.form)"/>
	  总共<? echo $pages ?>页，当前第<? echo $now ?>页&nbsp;
	  <? echo $thefirst ?>&nbsp;<? echo $theup ?> &nbsp;<? echo $thedown ?>&nbsp;<? echo $thelast ?>&nbsp;<br /><br />
	<center>
      <input type="submit" name="Submit" value="删 除" />
    </center></td>
    </tr>
</table>        
</form>










<?

}elseif ($_GET['step']==3)
{

switch ($mod){
case 1:
$idd=$_POST['delzhuti'];
for ($i=0;$i<count($idd);$i++){
$cid=(int)($idd[$i]);
$query=mysql_query("select * FROM `{$fkduo}zhuti` where `cid`='$cid' limit 1");
$row=mysql_fetch_array($query); if ($row[pic]!="0"){ unlink($row[pic]);}//删除附件
mysql_query("DELETE FROM `{$fkduo}zhuti` WHERE `cid`='$cid' limit 1");
mysql_query("DELETE FROM `{$fkduo}card` WHERE `cid`='$cid'");//删除回复
}
$url="fkduo_delusercard.php?step=2&mod=1&logname=".$_GET['logname']."&now=".$_GET['now']."";
break;

case 2:
$idd=$_POST['delhuifu'];
for ($i=0;$i<count($idd);$i++){
//$id=(int)($idd[$i]);
$aabb=explode(",",trim($idd[$i]));
$id=$aabb[0];
$cid=$aabb[1];
$query=mysql_query("select * FROM `{$fkduo}card` where `id`='$id' limit 1");
$row=mysql_fetch_array($query); if ($row[pic]!="0"){ unlink($row[pic]); }//删除附件
mysql_query("DELETE FROM `{$fkduo}card` WHERE `id`='$id'");
mysql_query("update `{$fkduo}zhuti` set `huifu`=`huifu`-1 where (`cid`='$cid') limit 1"); 
}
$url="fkduo_delusercard.php?step=2&mod=2&logname=".$_GET['logname']."&now=".$_GET['now']."";
break;

default;
echo "出错了！";
exit;
}


//$query=mysql_query($sql) or die("更新出错了!!!");//更新用户信息

echo "删除成功";
echo "[ <a href=".$url." ><font color=\"blue\">返回</font></a> ]";
}
?>
</body>
</html>
