<?
include 'check.php';

$logname=$_POST[logname];
$day=(int)($_POST[day]);
$locktime=$day*86400+mktime();//封号期限

switch ($_GET[action]){
case lock:
$query=mysql_query("select * FROM `{$fkduo}user` where `logname`='$logname' limit 1");
$jilu=mysql_num_rows($query);
if ($jilu==0){
echo "操作失败，没有这个用户名！";
exit;
}


$sql="update `{$fkduo}user` set `lock`='1',`locktime`='$locktime' where (`logname`='$logname') limit 1";
$query=mysql_query($sql);
$eee="lockuser.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>操作成功！</font>";
break;

case unlock:
$logname=$_GET[logname];
$sql="update `{$fkduo}user` set `lock`='0' where (`logname`='$logname') limit 1";
$query=mysql_query($sql);

$eee="lockuser.php?action=ok";
header ("location: $eee"); 
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
<h2>会员账号冻结-解冻管理！</h2>
(以下为被封号的会员) 
<table width="44%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#99CC99">用户名</td>
	<td bgcolor="#99CC99">冻结期限</td>
    <td bgcolor="#99CC99"></td>
  </tr>
  <?
  
  function uuuw($mkktime){
//$mkktime=(int)($mkktime);
$mkktime=date("y-m-d H:i:s",$mkktime);
return $mkktime;
}

$sql="select * FROM `{$fkduo}user` where `lock`='1' ORDER by `locktime`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
    <tr>
      <td><a href=../info.php?logname=<? echo $row[logname] ?> target=_blank> <? echo $row[logname] ?></a></td>
	  <td><? echo uuuw($row[locktime]) ?></td>
      <td><a href="lockuser.php?action=unlock&logname=<? echo $row[logname] ?>">解冻</a></td>
    </tr>
  <?
  }
  ?>
  </table><br><br>
  <table>
    <tr>
    <td bgcolor="#99CC99">用户名</td>
	<td bgcolor="#99CC99">封号天数(整数)</td>
    <td></td>
  </tr>
  
  <form id="form1" name="form1" method="post" action="lockuser.php?action=lock">
    <tr>
    <td><input name="logname" type="text" id="logname" accesskey="1" /></td>
	<td><input name="day" type="text" id="day" accesskey="2" value="1" size="10" /></td>
    <td><input type="submit" name="Submit" value="添 加" accesskey="3" /></td>
  </tr>
  </form>
</table>


</body>
</html>