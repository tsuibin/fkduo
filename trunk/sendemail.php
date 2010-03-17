<?
include 'conn.php';
require_once ('include/email.class.php');
include 'tis.php';
if (empty($_POST['email'])){
$tis="Email不能为空";
tis($tis);
exit;
}

//$emailcontrol="139.com,126.com,163.com";//配置里的
$emailcontrol1=explode(",",$sys_emailcontrol);
//$emailhou="126.com";
$email=trim($_POST['email']);
eregi("@(.*)", $email, $regs);

if (!in_array($regs[1],$emailcontrol1))
{
$tis= "出错了!!!<br />本站只允许使用以下后辍的邮箱注册：<br />".$sys_emailcontrol;
tis($tis);
exit;
}


$smtpemailto=addslashes($_POST['email']);
$code = substr(uniqid(rand()), -6);
include_once 'config/email.php';

$sql="INSERT INTO `{$fkduo}emailact` (`code`,`email`) VALUES ('$code','$smtpemailto')";
$query=mysql_query($sql);//更新日志
$id=mysql_insert_id();//取得自动产生的cid

$link=$siteurl."reg.php?id=".$id."&amp;code=".$code;
$mailsubject=$sitename."验证邮件";
$mailbody="验证成功！<p>请点击下面的链接进入填写个人信息,以完成最后的注册步骤：</p><p><a href=".$link.">".$link."</a></p>
<p>(如果上面不是链接形式，请将地址手工粘贴到浏览器地址栏再访问)</p><p>".$sitename."</p><p>".$siteurl."</p>";


$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = FALSE;//是否显示发送的调试信息
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: reg.php?action=sendok"); 
}else
{
$tis="发送不成功，请联系管理员！";
tis($tis);
}
?>