<? 
include 'check.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>

      <form id="form1" name="form1" method="post" action="bkmasterdel.php?action=list1">

<table width="36%" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">删除版主</td>
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
    <td><input type="submit" name="Submit" value="列 出 版 主" accesskey="3" /></td>
  </tr>
</table>      </form>

<?
	
	
switch ($_GET[action]){
case list1:
$bkid=$_POST[bkid];
$sql="select * FROM `{$fkduo}bkmaster` where (`bkid`='$bkid')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu>0){
while ($row=mysql_fetch_array($query)){
echo $row[uid]."<a href=bkmasterdel.php?action=del&uid=".$row[uid]."&bkid=".$row[bkid].">删除</a><br>"; }
}else
{
echo "<font color=red>当前此版没有版主</font>";
}
//$eee="bkmaster.php?action=ok&bk=".$bkid;
//header ("location: $eee"); 
break;

case del:
mysql_query("DELETE FROM `{$fkduo}bkmaster` WHERE (`bkid`='$_GET[bkid]' and `uid`='$_GET[uid]')");
mysql_query("update `{$fkduo}user` set `power`='9' where (`logname`='$_GET[uid]') limit 1");

echo "删除成功";
$eee="../make.php?action=listtop&bk=".$_GET[bkid];
echo "<iframe src=".$eee." width=\"300\" height=\"30\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>";
break;

default:
break;
}
	?>
	
</body>
</html>
