<?
include 'conn.php';
require_once ('include/email.class.php');
include 'tis.php';
if (empty($_POST['email'])){
$tis="Email����Ϊ��";
tis($tis);
exit;
}

//$emailcontrol="139.com,126.com,163.com";//�������
$emailcontrol1=explode(",",$sys_emailcontrol);
//$emailhou="126.com";
$email=trim($_POST['email']);
eregi("@(.*)", $email, $regs);

if (!in_array($regs[1],$emailcontrol1))
{
$tis= "������!!!<br />��վֻ����ʹ�����º�꡵�����ע�᣺<br />".$sys_emailcontrol;
tis($tis);
exit;
}


$smtpemailto=addslashes($_POST['email']);
$code = substr(uniqid(rand()), -6);
include_once 'config/email.php';

$sql="INSERT INTO `{$fkduo}emailact` (`code`,`email`) VALUES ('$code','$smtpemailto')";
$query=mysql_query($sql);//������־
$id=mysql_insert_id();//ȡ���Զ�������cid

$link=$siteurl."reg.php?id=".$id."&amp;code=".$code;
$mailsubject=$sitename."��֤�ʼ�";
$mailbody="��֤�ɹ���<p>������������ӽ�����д������Ϣ,���������ע�Ჽ�裺</p><p><a href=".$link.">".$link."</a></p>
<p>(������治��������ʽ���뽫��ַ�ֹ�ճ�����������ַ���ٷ���)</p><p>".$sitename."</p><p>".$siteurl."</p>";


$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//�������һ��true�Ǳ�ʾʹ�������֤,����ʹ�������֤.
$smtp->debug = FALSE;//�Ƿ���ʾ���͵ĵ�����Ϣ
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: reg.php?action=sendok"); 
}else
{
$tis="���Ͳ��ɹ�������ϵ����Ա��";
tis($tis);
}
?>