<? include 'check.php'; ?>
<?
switch ($_GET[action]){
case add:

$str= <<< EOT
<?
\$smtpserver = "$_POST[smtpserver]";    //SMTP������
\$smtpserverport ='$_POST[smtpserverport]';    //SMTP�������˿�
\$smtpusermail = "$_POST[smtpusermail]";    //SMTP���������û�����
\$smtpuser = "$_POST[smtpuser]";    //SMTP���������û��ʺ�
\$smtppass = "$_POST[smtppass]";    //SMTP���������û�����
\$mailtype = "HTML";    //�ʼ���ʽ��HTML/TXT��,TXTΪ�ı��ʼ�
?>
EOT;

  $he="../config/email.php";
  $handle=fopen($he,"w"); //д�뷽ʽ������·��
  fwrite($handle,$str); //�Ѹղ��滻������д�����ɵ�HTML�ļ�
  fclose($handle);
  //header ("location: email.php?action=ok");
  
  
require_once ('../include/email.class.php');
require_once ('../config/email.php');

$mailsubject= "�ʼ����Ͳ��ԣ�";
$mailbody= "����һ���ʼ����Ͳ���";
$smtpemailto=$_POST[smtpusermail];

$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
$smtp->debug = FALSE;//�Ƿ���ʾ���͵ĵ�����Ϣ
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: email.php?action=ok"); 
}else
{
echo "<script language=\"javascript\"> alert(\"���Բ��ɹ����������ã�\");</script>";
exit;
}//���Բ���

exit;

case ok:
echo "<script language=\"javascript\"> alert(\"��ϲ�����Գɹ�����ǰ���ÿ��Է����ʼ�..\");</script>";
break;

default:
break;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
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
    <td colspan="2" bgcolor="#FFFF00">�ʼ���������</td>
  </tr>
  <tr>
    <td>SMTP��������</td>
    <td>

        <input name="smtpserver" type="text" id="smtpserver" tabindex="1" value="<? echo $smtpserver ?>" />    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">SMTP�������˿�:</td>
    <td bgcolor="#CCCCCC"><input name="smtpserverport" type="text" id="smtpserverport" tabindex="1" value="<? echo $smtpserverport ?>" size="5" /></td>
  </tr>
  <tr>
    <td>SMTP���������û����䣺</td>
    <td><input name="smtpusermail" type="text" id="smtpusermail" tabindex="1" value="<? echo $smtpusermail ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">SMTP���������û��ʺ�:</td>
    <td bgcolor="#CCCCCC"><input name="smtpuser" type="text" id="smtpuser" tabindex="1" value="<? echo $smtpuser ?>" /></td>
  </tr>
  <tr>
    <td>SMTP���������û�����:</td>
    <td><input name="smtppass" type="text" id="smtppass" tabindex="1" value="<? echo $smtppass ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><label>
     <center> <input type="submit" name="Submit" value="�� �� �� ��" />
     </center></label></td>
    </tr>
</table>
</form>
</body>
</html>
