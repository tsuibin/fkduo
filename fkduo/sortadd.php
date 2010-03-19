<?
include 'check.php';

switch ($_GET[action]){
case add:
$bk=$_POST[bkid];
$name=$_POST[name];

$query=mysql_query("INSERT INTO `{$fkduo}sort` (`name`,`bk`) VALUES ('$name','$bk')");//更新日志
$eee="sortadd.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>话题归类增加成功!</fotn><br><br>";
break;

default:
break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>无标题文档</title>
</head>

<body>

      <form id="form1" name="form1" method="post" action="sortadd.php?action=add">

<table width="36%" height="108" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">添加话题归类</td>
    <td bgcolor="#9999FF"></td>
    <td bgcolor="#9999FF"></td>
  </tr>
  
  
  <tr>
    <td>选择版块：</td>
    <td>
	<select name="bkid" accesskey="1" >
<?
$sql="select * FROM `{$fkduo}bk` ORDER by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
<option value="<? echo $row[bkid] ?>" selected="selected"><? echo $row[bkname] ?></option>
<?
}
?>
</select>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>话题归类</td>
    <td><label>
          <input type="text" name="name" accesskey="2" />
        </label>    </td>
    <td><label>
      <input type="submit" name="Submit" value="添 加" accesskey="3" />
      </label></td>
  </tr>
</table>      </form>
  <a href="sortdel.php" target="main">话题归类删除</a><br />
</body>
</html>
