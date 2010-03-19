<?
include 'check.php';
if (empty($_GET[step])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>无标题文档</title>
</head>

<body>


<form id="form1" name="form1" method="post" action="sign.php?step=2">
<p>批量修改用户帖子签名：</p>
<p>用户名：</p>

  <label>
  <input type="text" name="logname" />
  </label>

<p>替换签名(留空直接清空)：</p>
<p>
  <label>
  <textarea name="sign" cols="40" rows="7">这家伙很懒，没有写签名!</textarea>
  </label>
</p>
<p>期限：
  <label>
  <input name="howtime" type="radio" value="3" checked="checked" />
  三天内</label>
  <label>
  <input type="radio" name="howtime" value="7" />
一周内</label>
  <label>
  <input type="radio" name="howtime" value="30" />
  一月内</label>
  <label>
  <input type="radio" name="howtime" value="0" />
  所有时间
  </label>
</p>
<p>
  <label>
  <input type="submit" name="Submit" value="修改" />
  </label>
</p>
</form>

<?
}elseif ($_GET[step]==2){
$logname=ruku($_POST[logname]);
$sign=ruku($_POST[sign]);
$how=$howtime=(int)($_POST[howtime]);
$timenow=mktime();

$sql="select * from {$fkduo}user where `logname`='$logname' limit 1";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu==0){
echo "没有这个用户";
echo "[ <a href=\"javascript:history.back(1)\" ><font color=\"blue\">返回</font></a> ]";
exit;
}


if ($howtime==0){
mysql_query("update `{$fkduo}zhuti` set `sign`='$sign' where (`firstlogname`='$logname')") or die("出错了") ;
mysql_query("update `{$fkduo}card` set `sign`='$sign' where (`lastlogname`='$logname')") or die("出错了");

echo "用户:".$logname."所有时间的签名更新成功！";
}else
{
$howtime=$timenow-($howtime*86400);

mysql_query("update `{$fkduo}zhuti` set `sign`='$sign' where `firstlogname`='$logname' and `firsttime` between '$howtime' and '$timenow'") or die("出错了");
mysql_query("update `{$fkduo}card` set `sign`='$sign' where `lastlogname`='$logname' and `lasttime` between '$howtime' and '$timenow'") or die("出错了");

echo "用户:".$logname.$how."天内的签名更新成功！";
}
}
?>
</body>
</html>