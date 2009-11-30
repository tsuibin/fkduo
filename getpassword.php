<?
include 'conn.php';

if (empty($_GET['action'])){
include_once 'xingTemplate.php';
$xingTemplate->display('getpassword');
exit;
}

include_once 'tis.php';
if ($_GET['action']==ok){
$tis="请求成功!<br>我们会于5分钟内叫人把新密码发送到您的邮箱，请稍候查收！";
tis($tis);
exit;
}

if (empty($_POST['logname'])){
$tis="用户名不能为空";
tis($tis);
exit;
}

if (empty($_POST['email'])){
$tis="Email不能为空";
tis($tis);
exit;
}

$logname=trim($_POST['logname']);
$logname=addslashes($logname);

$sql="select * FROM `{$fkduo}user` where (`logname`='$logname') limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);
$salt=$row[salt];

if ($row[email]==$_POST['email']){

$email=trim($_POST['email']);
$passnow = substr(uniqid(rand()), -6);//生成新密码
$password = md5(md5($passnow).$salt);
mysql_query("update `{$fkduo}user` set `pass`='$password' where (`logname`='$logname') limit 1");//更改密码

$mailsubject=$sitename."取回密码";
$mailbody="您的密码已经被重置为：".$passnow."<br>请即刻登录修改，谢谢！<br>".$sitename."<br>".$siteurl;
$smtpemailto=$email;

//---------------------------------------
include_once ('include/email.class.php');
include_once ('config/email.php');

$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//true是表示使用身份验证
$smtp->debug = FALSE;//是否显示发送的调试信息
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: getpassword.php?action=ok"); 
}else
{
$tis="发送不成功，请联系管理员！";
tis($tis);
exit;
}
//---------------------------------------
}else{
$tis="用户名和邮箱对不上号！请再想想";
tis($tis);
}


?>