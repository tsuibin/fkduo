<? 
include 'check.php';

switch ($_GET[action]){
case add:
$bkid=$_POST[bkid];
$logname=$_POST[logname];

$sql="select * FROM `{$fkduo}bkmaster` where (`uid`='$logname' and `bkid`='$bkid')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu>0){
echo "<font color=red>不要重复添加，此人本来就是这个版的版主</fotn>";
exit;
}


$sql="select * FROM `{$fkduo}user` where `logname`='$logname'";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu==0){
echo "<font color=red>没有这个用户名，会不会写错了!</fotn>";
exit;
}



mysql_query("INSERT INTO `{$fkduo}bkmaster` (`uid`,`bkid`) VALUES ('$logname','$bkid')");//增加版主
mysql_query("update `{$fkduo}user` set `power`='3' where (`logname`='$logname') limit 1");

$eee="bkmasteradd.php?action=ok&bk=".$bkid;
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>版主增加成功</fotn><br><br>";
$eee="../make.php?action=listtop&bk=".$_GET[bk];
echo "<iframe src=".$eee." width=\"300\" height=\"30\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>";
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

      <form id="form1" name="form1" method="post" action="bkmasteradd.php?action=add">

<table width="36%" height="108" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">添加版主</td>
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
<option value="<? echo $row['bkid'] ?>" selected="selected"><? echo $row['bkname'] ?></option>
<?
}
?>
</select>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>用户名</td>
    <td><label>
          <input type="text" name="logname" accesskey="2" />
        </label>    </td>
    <td><label>
      <input type="submit" name="Submit" value="添 加" accesskey="3" />
      </label></td>
  </tr>
</table>      </form>
</body>
</html>
