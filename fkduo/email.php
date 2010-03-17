<? include 'check.php'; ?>
<?
switch ($_GET[action]){
case add:

$str= <<< EOT
<?
\$smtpserver = "$_POST[smtpserver]";    //SMTP服务器
\$smtpserverport ='$_POST[smtpserverport]';    //SMTP服务器端口
\$smtpusermail = "$_POST[smtpusermail]";    //SMTP服务器的用户邮箱
\$smtpuser = "$_POST[smtpuser]";    //SMTP服务器的用户帐号
\$smtppass = "$_POST[smtppass]";    //SMTP服务器的用户密码
\$mailtype = "HTML";    //邮件格式（HTML/TXT）,TXT为文本邮件
?>
EOT;

  $he="../config/email.php";
  $handle=fopen($he,"w"); //写入方式打开新闻路径
  fwrite($handle,$str); //把刚才替换的内容写进生成的HTML文件
  fclose($handle);
  //header ("location: email.php?action=ok");
  
  
require_once ('../include/email.class.php');
require_once ('../config/email.php');

$mailsubject= "邮件发送测试！";
$mailbody= "这是一封邮件发送测试";
$smtpemailto=$_POST[smtpusermail];

$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = FALSE;//是否显示发送的调试信息
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: email.php?action=ok"); 
}else
{
echo "<script language=\"javascript\"> alert(\"测试不成功，请检查配置！\");</script>";
exit;
}//测试部分

exit;

case ok:
echo "<script language=\"javascript\"> alert(\"恭喜，测试成功！当前配置可以发送邮件..\");</script>";
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
<style type="text/css">
<!--
.aaaa {
	font-size: 12px;
}
-->
</style>
</head>

<body>
<?
if(file_exists("../config/email.php")){
include '../config/email.php';
} 
?>

<form action="email.php?action=add" method="post" name="form1" class="aaaa" id="form1">
<table width="515" height="495" border="1">
  <tr>
    <td colspan="2" bgcolor="#FFFF00">邮件发送配置</td>
  </tr>
  <tr>
    <td>SMTP服务器：</td>
    <td>

        <input name="smtpserver" type="text" id="smtpserver" tabindex="1" value="<? echo $smtpserver ?>" />    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">SMTP服务器端口:</td>
    <td bgcolor="#CCCCCC"><input name="smtpserverport" type="text" id="smtpserverport" tabindex="1" value="<? echo $smtpserverport ?>" size="5" /></td>
  </tr>
  <tr>
    <td>SMTP服务器的用户邮箱：</td>
    <td><input name="smtpusermail" type="text" id="smtpusermail" tabindex="1" value="<? echo $smtpusermail ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">SMTP服务器的用户帐号:</td>
    <td bgcolor="#CCCCCC"><input name="smtpuser" type="text" id="smtpuser" tabindex="1" value="<? echo $smtpuser ?>" /></td>
  </tr>
  <tr>
    <td>SMTP服务器的用户密码:</td>
    <td><input name="smtppass" type="text" id="smtppass" tabindex="1" value="<? echo $smtppass ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><label>
     <center> <input type="submit" name="Submit" value="提 交 修 改" />
     </center></label></td>
    </tr>
</table>
</form>
</body>
</html>
