<?
include 'check.php';

$name=$_POST[name];
$url=$_POST[url];
$id=(int)($_GET[id]);
$px=(int)($_POST[px]);

switch ($_GET[action]){
case add:
$query=mysql_query("INSERT INTO `{$fkduo}link` (`name`,`url`,`px`) VALUES ('$name','$url','$px')");//更新日志
$eee="link.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>操作成功！</font>";
$eee="../make.php?action=link";
echo "<iframe src=".$eee." width=\"300\" height=\"30\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>";

break;

case del:
mysql_query("DELETE FROM `{$fkduo}link` WHERE `id`='$id'");
$eee="link.php?action=ok";
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
<h2>友情链接！</h2>(只出现在首页底部)
<table width="44%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#99CC99">网站名称</td>
	<td bgcolor="#99CC99">排序</td>
    <td bgcolor="#99CC99"></td>
  </tr>
  <?
$sql="select * FROM `{$fkduo}link` ORDER by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
    <tr>
      <td><a href=<? echo $row[url] ?> target=_blank><? echo $row[name] ?></a></td>
	  <td><? echo $row[px] ?></td>
      <td><a href="link.php?action=del&id=<? echo $row[id] ?>">删除</a></td>
    </tr>
  <?
  }
  ?>
  </table><br><br>
  <table>
    <tr>
    <td bgcolor="#99CC99">网站名称</td>
	<td bgcolor="#99CC99">网址</td>
    <td bgcolor="#99CC99">排序</td>
  </tr>
  
  <form id="form1" name="form1" method="post" action="link.php?action=add">
    <tr>
    <td><input name="name" type="text" id="name" accesskey="1" /></td>
	<td><input name="url" type="text" id="url" accesskey="2" value="http://" /></td>
    <td><input name="px" type="text" id="px" accesskey="2" value="1" size="6" />
    <input type="submit" name="Submit" value="添加" accesskey="3" /></td>
  </tr>
  </form>
</table>


</body>
</html>