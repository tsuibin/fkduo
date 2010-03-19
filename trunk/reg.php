<?
include 'conn.php';
//include 'tis.php';
include 'xingTemplate.php';

if ($regemail==1 and $_GET['action']==sendok){
$xingTemplate->display('regemail');
exit;
}

if ($regemail==0){
$xingTemplate->display('reg');
exit;
}else
{
if (empty($_GET['id'])){
//$tis="未知错误，您需要通过邮件验证后才能访问本页面！";
$xingTemplate->display('regemail');
exit;
}else{
$_SESSION[id]=$id=(int)($_GET['id']);
$code=ruku($_GET['code']);
$query=mysql_query("select * FROM `{$fkduo}emailact` where `id`='$id' and `code`='$code' and `doo`='0'");
$row=mysql_fetch_array($query);
$jilu=mysql_num_rows($query);

if ($jilu=='0'){
$tis="对不起，您的验证码不正确或已过期！";
$xingTemplate->display('tis');
exit;
}
$_SESSION[email]=$email=$row[email];
$_SESSION[regallow]=1;
$xingTemplate->display('reg');
}
}

?>