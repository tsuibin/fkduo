<?
include 'conn.php';
include 'tis.php';

if ($regemail==1 and $_SESSION[regallow]!=1){
$tis= "�Բ���ע������ͨ���ʼ���֤!";
tis($tis);
exit;
}

if (empty($_POST['password'])){
$tis= "�Բ������벻��Ϊ��!";
tis($tis);
exit;
}

if ($regemail==0){
$_POST['email']=trim($_POST['email']);
if(!ereg('^[a-zA-Z0-9\._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$',$_POST['email'])) 
{ 
$tis= "Email��ʽ����ȷ�����ߺ��зǷ��ַ�����������д"; 
tis($tis);
exit;
}}

if (empty($_POST['logname'])){
$tis= "�Բ����û�������Ϊ��!";
tis($tis);
exit;
}

$_POST['logname']=trim($_POST['logname']);

if(!ereg("^[a-zA-Z][a-zA-Z0-9_]{3,15}$",$_POST['logname']))  
{ 
$tis= "�����ˣ��û���������Ӣ����ĸ��ͷ��������(��ĸ,���ֺ��»���)�����<br />��������Ϊ��4-15�����ַ�"; 
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
$tis= "�Բ��𣬴������ѱ�ע�����!�뻻һ��";
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
$tis= "���û����Ѿ�����ʹ���ˣ������һ��";
tis($tis);
exit;
}else
{
$sql="INSERT INTO `{$fkduo}user` (`logname`,`pass`,`email`,`nickname`,`regtime`,`lasttime`,`salt`) VALUES ('$logname','$password','$email','$nickname','$regtime','$lasttime','$salt')";
$query=mysql_query($sql);//������־

$_SESSION[logname]=$logname;
$_SESSION[power]='9';
$_SESSION[hp]='1';
$_SESSION[pp]=$_SESSION[lock]=$_SESSION[picallow]=$_SESSION[ppallow]='0';
$_SESSION[holdtimes]=mktime();

mysql_query("update `{$fkduo}emailact` set `doo`='1' where (`id`='$_SESSION[id]') limit 1");

$title="��ϲ�����Ѿ��ɹ�ע�᱾��̳!";
$content="���������ص��ط��ɷ��棬лл��";
$from=$sitename;
$to=$_SESSION[logname];
$time=mktime();
$sql="INSERT INTO `{$fkduo}sms` (`title`,`content`,`from`,`fromnkname`,`to`,`time`,`read`) VALUES ('$title','$content','$from','$fromnkname','$to','$time','0')";
$query=mysql_query($sql);//����ע��ɹ�ף�ض���.

header ("location: my.php?action=mysms"); 
}
?>