<?
include 'conn.php';

if (empty($_GET['action'])){
include_once 'xingTemplate.php';
$xingTemplate->display('getpassword');
exit;
}

include_once 'tis.php';
if ($_GET['action']==ok){
$tis="����ɹ�!<br>���ǻ���5�����ڽ��˰������뷢�͵��������䣬���Ժ���գ�";
tis($tis);
exit;
}

if (empty($_POST['logname'])){
$tis="�û�������Ϊ��";
tis($tis);
exit;
}

if (empty($_POST['email'])){
$tis="Email����Ϊ��";
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
$passnow = substr(uniqid(rand()), -6);//����������
$password = md5(md5($passnow).$salt);
mysql_query("update `{$fkduo}user` set `pass`='$password' where (`logname`='$logname') limit 1");//��������

$mailsubject=$sitename."ȡ������";
$mailbody="���������Ѿ�������Ϊ��".$passnow."<br>�뼴�̵�¼�޸ģ�лл��<br>".$sitename."<br>".$siteurl;
$smtpemailto=$email;

//---------------------------------------
include_once ('include/email.class.php');
include_once ('config/email.php');

$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//true�Ǳ�ʾʹ�������֤
$smtp->debug = FALSE;//�Ƿ���ʾ���͵ĵ�����Ϣ
if ($smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype)){
header ("location: getpassword.php?action=ok"); 
}else
{
$tis="���Ͳ��ɹ�������ϵ����Ա��";
tis($tis);
exit;
}
//---------------------------------------
}else{
$tis="�û���������Բ��Ϻţ���������";
tis($tis);
}


?>