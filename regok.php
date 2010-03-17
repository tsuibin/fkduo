<?
include 'conn.php';
include 'tis.php';

if ($regemail==1 and $_SESSION[regallow]!=1){
$tis= "对不起，注册请先通过邮件验证!";
tis($tis);
exit;
}

if (empty($_POST['password'])){
$tis= "对不起，密码不能为空!";
tis($tis);
exit;
}

if ($regemail==0){
$_POST['email']=trim($_POST['email']);
if(!ereg('^[a-zA-Z0-9\._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$',$_POST['email'])) 
{ 
$tis= "Email格式不正确，或者含有非法字符，请认真填写"; 
tis($tis);
exit;
}}

if (empty($_POST['logname'])){
$tis= "对不起，用户名不能为空!";
tis($tis);
exit;
}

$_POST['logname']=trim($_POST['logname']);

if(!ereg("^[a-zA-Z][a-zA-Z0-9_]{3,15}$",$_POST['logname']))  
{ 
$tis= "出错了，用户名必须是英文字母开头，允许含有(字母,数字和下划线)的组合<br />长度限制为（4-15）个字符"; 
tis($tis);
exit;
}


if ($regemail==1){
$email=$_SESSION[email];
}else
{
$email=addslashes($_POST['email']);
}


if ($emailre==1){
$query=mysql_query("select * from `{$fkduo}user` where (`email`='$email')");
$jilu=mysql_num_rows($query);
if ($jilu>0){
$tis= "对不起，此邮箱已被注册过了!请换一个";
tis($tis);
exit;
}
}


$nickname=$logname=addslashes($_POST['logname']);
$lasttime=$regtime =mktime();
$password=$_POST['password'];
$salt = substr(uniqid(rand()), -6);
$password = md5(md5($password).$salt);

$query=mysql_query("select * from `{$fkduo}user` where (`logname`='$logname')");
$row=mysql_fetch_array($query);
if ($logname===$row[logname]) {
$tis= "此用户名已经有人使用了，请更换一个";
tis($tis);
exit;
}else
{
$sql="INSERT INTO `{$fkduo}user` (`logname`,`pass`,`email`,`nickname`,`regtime`,`lasttime`,`salt`) VALUES ('$logname','$password','$email','$nickname','$regtime','$lasttime','$salt')";
$query=mysql_query($sql);//更新日志

$_SESSION[logname]=$logname;
$_SESSION[power]='9';
$_SESSION[hp]='1';
$_SESSION[pp]=$_SESSION[lock]=$_SESSION[picallow]=$_SESSION[ppallow]='0';
$_SESSION[holdtimes]=mktime();

mysql_query("update `{$fkduo}emailact` set `doo`='1' where (`id`='$_SESSION[id]') limit 1");

$title="恭喜，您已经成功注册本论坛!";
$content="发言请遵守当地法律法规，谢谢！";
$from=$sitename;
$to=$_SESSION[logname];
$time=mktime();
$sql="INSERT INTO `{$fkduo}sms` (`title`,`content`,`from`,`fromnkname`,`to`,`time`,`read`) VALUES ('$title','$content','$from','$fromnkname','$to','$time','0')";
$query=mysql_query($sql);//发送注册成功祝贺短信.

header ("location: my.php?action=mysms"); 
}
?>