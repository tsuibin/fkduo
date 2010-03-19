<? 
include '../conn.php';

if ($_SESSION[power]>3){
echo "<font color=red>管理重地，闲人勿进！</font>";
exit;
}


if (empty($_SESSION[logname])){
echo "请先从前台登陆！";
exit;
}



switch ($_GET[action]){
case log:
$logname=addslashes($_POST[logname]);
$password=$_POST[password];

$sql="select * FROM `{$fkduo}fkduo` where (logname='$logname')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
$row=mysql_fetch_array($query);
$salt=$row[salt];

if ($jilu==0 or $_SESSION[logname]!=$logname){
echo "<font color=red>用户名或密码错误！</font>";
session_destroy();
exit;
}

$password=md5(md5($password).$salt);
if ($row[password]===$password) {
$_SESSION[power]='1';
header ("location: f.php");
}else
{
echo "<font color=red>用户名或密码错误！</font>";
session_destroy();
exit;
}
break;

case out:
$_SESSION[power]=3;
echo "<font color=red>您已经成功退出高级管理状态。</font>";
exit;
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
管理员登陆：
<form id="form1" name="form1" method="post" action="log.php?action=log">
  <label>用户名
  <input type="text" name="logname" tabindex="1" />
  </label>
  <p>
    <label>密码 &nbsp;
    <input type="password" name="password" tabindex="2" />
    </label>
  </p>
  <p>
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="Submit" value="提交" tabindex="3" />
    </label>
  </p>
</form>
</body>
</html>
