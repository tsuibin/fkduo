<?
include 'check.php';

$oldw=$_POST[oldw];
$id=(int)($_GET[id]);

switch ($_GET[action]){
case add:
$query=mysql_query("INSERT INTO `{$fkduo}replace` (`oldw`,`type`) VALUES ('$oldw','2')");//更新日志
$bkid=mysql_insert_id();
$eee="replace2.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>操作成功！</font>";
break;

case del:
mysql_query("DELETE FROM `{$fkduo}replace` WHERE `id`='$id'");
$eee="replace2.php?action=ok";
header ("location: $eee"); 
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
<h2>设置转为后台审核的词语！</h2>
(说明:当帖子中含有以下词语时将自动转到后台审核)
<table width="44%" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#99CC99">词语</td>
    <td bgcolor="#99CC99"></td>
  </tr>
  <?
$sql="select * FROM `{$fkduo}replace` where `type`='2' ORDER by `id`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
    <tr>
      <td><? echo $row[oldw] ?></td>
      <td><a href="replace2.php?action=del&id=<? echo $row[id] ?>">删除</a></td>
    </tr>
  <?
  }
  ?>
</table>


<form id="form1" name="form1" method="post" action="replace2.php?action=add">
  <label>词语：
  <input name="oldw" type="text" id="oldw" accesskey="1" />
  </label>
  <label>
  <input type="submit" name="Submit" value="添加" accesskey="3" />
  </label>
</form>

<br /><br />
请注意：过多过滤词会影响发贴速度。

</body>
</html>