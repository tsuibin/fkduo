<?
include 'conn.php';
include 'check.php';

if ($_GET['action']==send){//SMS���ʹ���
$to=ruku($_POST['to']);
$from=$_SESSION[logname];

$title=$_POST['title'];
$title=htmlentities($title, ENT_QUOTES,utf8);
$title=str_replace("\r\n","",$title);
$title=addslashes($title);

$content=$_POST['content'];
$content=htmlentities($content, ENT_QUOTES,utf8);
$content=str_replace("\r\n","<br />",$content);  
$content=addslashes($content);

if (empty($title) or empty($to)) {
$tis= "������û���Ϊ�գ�����ʧ��"; 
tis($tis);
exit;
}

$sql6="select * FROM `{$fkduo}user` where (`logname`='$to') limit 1";
$query6=mysql_query($sql6);
$jilu=mysql_num_rows($query6);
if ($jilu==0){
$tis="�Ҳ�������û���������ʧ��!";
tis($tis);
exit;
}

$sql="select * FROM `{$fkduo}user` where (`logname`='$from') limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);
$fromnkname=$row[nickname];

$time=mktime();
$sql="INSERT INTO `{$fkduo}sms` (`title`,`content`,`from`,`fromnkname`,`to`,`time`,`read`) VALUES ('$title','$content','$from','$fromnkname','$to','$time','0')";
$query=mysql_query($sql);//������־

header ("location: my.php?action=mysms&mod=sendok"); 
exit;}




if ($_GET['action']==del){//SMSɾ������

switch ($_GET['mod']){
case listt:
$idd=$_POST['Idx'];
for ($i=0;$i<count($idd);$i++){
$id=(int)($idd[$i]);
mysql_query("DELETE FROM `{$fkduo}sms` WHERE `id`='$id' and `to`='$_SESSION[logname]'");
}
break;

case one:
$idd=(int)($_GET['id']);
mysql_query("DELETE FROM `{$fkduo}sms` WHERE `id`='$idd' and `to`='$_SESSION[logname]'");
break;

default;
echo "�����ˣ�";
exit;
}
header ("location: my.php?action=mysms&mod=delok"); 
exit;
}




if ($_GET['action']==myinfook){//������Ϣ�޸Ĵ���
if (empty($_POST['oldpassword'])){
$tis= "��û������ԭ����";
tis($tis);
exit;
}

if (!preg_match( "/^[^_][".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]{1,20}$/s ",$_POST['nickname'])) { 
$tis= "�����ˣ��ǳƲ��ܺ����������<br />(ֻ�����֣�Ӣ����ĸ�����ֺ��»��ߣ��м䲻���пո񣬳���10���ַ���)"; 
tis($tis);
exit;
}

$_POST['email']=trim($_POST['email']);
if(!ereg('^[a-zA-Z0-9\._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$',$_POST['email'])) 
{ 
$tis= "Email��ʽ����ȷ�����ߺ��зǷ��ַ�����������д"; 
tis($tis);
exit;
}


$sql="select * from `{$fkduo}user` where (logname='$_SESSION[logname]')";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);

$nickname=ruku($_POST['nickname']);
$area=ruku($_POST['area']);
$email=ruku($_POST['email']);

$password=$row[pass];
$oldpassword = md5(md5($_POST['oldpassword']).$row[salt]);

if ($oldpassword!=$password){
$tis= "���벻�ԣ���ʲô�ɻ�����";
tis($tis);
exit;
}

$sign=$_POST['sign'];
$sign=htmlentities($sign, ENT_QUOTES,utf8);
$sign=str_replace("\r\n","<br />",$sign);
$sign=addslashes($sign);

if (!empty($_POST['newpassword'])){//�������Ƿ�����
$password = md5(md5($_POST['newpassword']).$row[salt]);
}

$sql="update `{$fkduo}user` set `nickname`='$nickname',`pass`='$password',`email`='$email',`area`='$area',`sign`='$sign' where (`logname`='$_SESSION[logname]') limit 1";
$query=mysql_query($sql);
header ("location: my.php?action=myinfo&mod=ok"); 
exit;}







if ($_GET['action']==myfaceok){//ͷ���ϴ�����
if (is_uploaded_file($_FILES['upfile']['tmp_name'])){
$upfile=$_FILES["upfile"];
$type = $upfile["type"];
$size = $upfile["size"];
$tmp_name = $upfile["tmp_name"];
$error = $upfile["error"];
$image_size = getimagesize($tmp_name);
$face_size=$face_size*1000;


if ($size>$face_size){
$tis= "�����ϴ���ͷ���ļ���С���ܳ���".($face_size/1000)."K";
 tis($tis);
exit;
}

if ($image_size[0]>100 or $image_size[1]>100){
$tis= "����ͼƬ�ߴ���������100*100����";
 tis($tis);
exit;
}


switch ($type) {
	case 'image/pjpeg' : $ok=1;
	    $name=$_SESSION[logname].".jpg";
		$face=jpg;
		break;
	case 'image/jpeg' : $ok=1;
	    $name=$_SESSION[logname].".jpg";
		$face=jpg;
		break;
	case 'image/gif' : $ok=1;
	    $name=$_SESSION[logname].".gif";
		$face=gif;
		break;
	default:
		echo "��������ļ�����";
		exit;
}

$name="html/face/".$name;

if($ok && $error=='0'){
 move_uploaded_file($tmp_name,$name); 
 mysql_query("update `{$fkduo}user` set `face`='$face' where (`logname`='$_SESSION[logname]') limit 1");
 $tis= "ͷ���ϴ��ɹ���<br />������ͷ��ͼƬû���£���ˢ��һ�¡�"; 
 tis($tis);
}
}exit;}





if ($_GET['action']==favdel){//�ղؼ�ɾ��
switch ($_GET['mod']){
case listt:
$idd=$_POST['Idx'];
$how=count($idd);
for ($i=0;$i<count($idd);$i++){
$id=(int)($idd[$i]);
mysql_query("DELETE FROM `{$fkduo}fav` WHERE `cid`='$id' and `favuser`='$_SESSION[logname]'");
}

mysql_query("update `{$fkduo}user` set `favcount`=`favcount`-'$how' where (`logname`='$_SESSION[logname]')");
break;

default;
echo "�����ˣ�";
exit;
}
header ("location: my.php?action=myfav&mod=delok"); 
}
?>