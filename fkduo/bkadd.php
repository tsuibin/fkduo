<?
include 'check.php';

$bkname=$_POST[bkname];
$bkjj=$_POST[bkjj];

switch ($_GET[action]){
case add:
$query=mysql_query("INSERT INTO `{$fkduo}bk` (`bkname`,`bkjj`) VALUES ('$bkname','$bkjj')");//更新日志
$bkid=mysql_insert_id();

$regtime=$firsttime=$lasttime=time();

$title="每个版面默认的都要有一个帖子";
$content="如果删除了则版面打不开，请从回收站恢复一下！";
$sql="INSERT INTO `{$fkduo}zhuti` (`title`,`content`,`bk`,`firstlogname`,`firstnkname`,`firsttime`,`ip`,`lastnkname`,`lastlogname`,`lasttime`,`pic`,`img`,`regtime`,`hp`,`pp`,`area`,`sign`,`through`,`zts`,`hfs`,`face`,`sort`,`replyview`) VALUES ('$title','$content','$bkid','test','test','$firsttime','127.0.0.1','test','test','$lasttime','0','0','$regtime','1','1','保密','no sign','0','1','1','1','[无]','0')";

$query=mysql_query($sql);//发布第一个贴子

$eee="bkadd.php?action=ok&bkid=".$bkid;
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>增加成功！</font>";
$bkid=$_GET[bkid];
echo $eee1="../make.php?action=listtop&bk=".$bkid;
$eee2="../make.php?action=head";
echo "<iframe src=".$eee1." width=\"0\" height=\"0\"></iframe>";
echo "<iframe src=".$eee2." width=\"0\" height=\"0\"></iframe>";
break;

default:
break;
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="bkadd.php?action=add">
  <label>新增版面
  <input name="bkname" type="text" id="bjname" accesskey="1" />
  </label>
  <label> <br />
  <br />
  版面简介
  <textarea name="bkjj" cols="40" rows="3" id="bkjj" accesskey="2"></textarea>
  <br />
  <br />
  <input type="submit" name="Submit" value="提交" accesskey="3" />
  </label>
</form>



</body>
</html>
