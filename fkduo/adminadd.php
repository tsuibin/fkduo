<? 
include 'check.php';

switch ($_GET[action]){
case add:
if (empty($_POST[logname]) or empty($_POST[password])){
echo "<font color=red>出错了，用户和密码都要填写完整！</font>";
exit;
}

$logname=$_POST[logname];
$password=$_POST[password];

$query=mysql_query("select `logname` from `{$fkduo}user` where `logname`='$logname' limit 1");
$jilu=mysql_num_rows($query);
if ($jilu==0){
echo "<font color=red>错误，管理员必须是论坛已有的注册会员！</font>";
exit;
}


$salt = substr(uniqid(rand()), -6);
$password = md5(md5($password).$salt);

mysql_query("INSERT INTO `{$fkduo}fkduo` (`logname`,`password`,`salt`) VALUES ('$logname','$password','$salt')");//更新日志

$sql="update `{$fkduo}user` set `power`='3' where (`logname`='$logname') limit 1";
$query=mysql_query($sql);

$eee="adminadd.php?action=ok";
header ("location: $eee"); 
break;

case del:
$sql="select `id` FROM `{$fkduo}fkduo`";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu<2){
echo "<font color=red>必须保留至少一位管理员</font>";
break;
}else{
mysql_query("DELETE FROM `{$fkduo}fkduo` WHERE `id`='$_GET[id]'");
mysql_query("update `{$fkduo}user` set `power`='9' where `logname`='$_GET[logname]' limit 1");
echo "删除成功";
}
break;


case ok:
echo "<font color=red>增加成功!</font><br><br>";
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

      <form id="form1" name="form1" method="post" action="adminadd.php?action=add">

<table width="36%" height="108" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">添加管理员</td>
    <td bgcolor="#9999FF"></td>
    <td bgcolor="#9999FF"></td>
  </tr> 
  


  <tr>
    <td>用户名</td>
    <td><label>
          <input type="text" name="logname" accesskey="2" />
        </label>    </td>
    <td></td>
  </tr>
  
    <tr>
    <td>管理密码</td>
    <td><label>
          <input type="password" name="password" accesskey="3" />
        </label>    </td>
    <td><label>
      <input type="submit" name="Submit" value="添 加" accesskey="4" />
      </label></td>
  </tr>
  
</table>      </form>
 <?
  $sql="select * FROM `{$fkduo}fkduo`";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);?>
  当前管理员<font color=red><? echo $jilu ?></font>位：<br />
  <?

while ($row=mysql_fetch_array($query)){
echo $row[id].".".$row[logname]."&nbsp;<a href=adminadd.php?action=del&logname=".$row[logname]."&id=".$row[id].">删除</a><br>";
}
  ?>
  <br />
  <br />
  <br />
  修改管理员密码：<br />
  (功能开发中，请先删除，然后重新添加即可)
</body>
</html>
