<? 
include 'check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>无标题文档</title>
</head>

<body>

      <form id="form1" name="form1" method="post" action="sortdel.php?action=list1">

<table width="36%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">删除话题归类</td>
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
    <td><input type="submit" name="Submit" value="列出话题归类" accesskey="3" /></td>
  </tr>
</table>      </form>

<?
	
	
switch ($_GET[action]){
case list1:
$bkid=$_POST[bkid];
$sql="select * FROM `{$fkduo}sort` where (`bk`='$bkid')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu>0){
while ($row=mysql_fetch_array($query)){
echo $row[name]."<a href=sortdel.php?action=del&id=".$row[id].">删除</a><br>"; }
}else
{
echo "<font color=red>当前此版没有话题归类</font>";
}
//$eee="bkmaster.php?action=ok&bk=".$bkid;
//header ("location: $eee"); 
break;

case del:
mysql_query("DELETE FROM `{$fkduo}sort` WHERE `id`='$_GET[id]'");
echo "删除成功";
break;

default:
break;
}
	?>
	
</body>
</html>
