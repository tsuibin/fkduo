<?
$yanc=1;
include 'conn.php';
include 'check.php';

$_POST['title']=trim($_POST['title']);

if (empty($_POST['message']) or empty($_POST['title']) or empty($_GET['bk'])){
$tis= "�����������ݻ���ⲻ��Ϊ�գ������������ҳ����в���"; 
tis($tis);
exit;
}

$query=mysql_query("select * from {$fkduo}bk where `bkid`='$bk' limit 1");
$jilu=mysql_num_rows($query);
if ($jilu==0){
$tis= "�����ύ�İ��治���ڣ�"; 
tis($tis);
exit;
}


$lasttime=$firsttime=mktime();

$query9=mysql_query("select * FROM `{$fkduo}user` where `logname`='$_SESSION[logname]' limit 1");
$row9=mysql_fetch_array($query9) ;
if ($row9[lock]==1){
$tis= "�Բ�������˺Ŵ��ڶ����ڣ��޷�������";
tis($tis);
exit;
}

if (($lasttime-$row9[lastft])<$ftime){
$tis= "�Բ�����ķ������ʱ������".$ftime."�룡";
tis($tis);
exit;
}


if (is_uploaded_file($_FILES["upfile"][tmp_name]))//�Ƿ����ϴ��ļ�Ҫ����
{

if ($_SESSION[picallow]<1){
$tis= "������ķ�ͼ��������꣡";
tis($tis);
exit;
}

$smallmark = 1; //��������ͼ
include 'up.php';
}else
{
$img=0;
}
			
if (!$pic){
$pic=0;
}			

if (empty($_POST['bk'])) {
$tis= "�����飬�������ҳ����뷢��"; //�ж��Ƿ��а��
tis($tis);
exit;
}


$sortid=(int)($_POST['sortid']);
if ($sortid==0){
$sort="";
}else
{
$query=mysql_query("select * FROM `{$fkduo}sort` where `id`='$sortid'");
$row=mysql_fetch_array($query);
$sort="[".$row[name]."]";
}


if ($_POST['replyview']==1){
$replyview=1;
}else
{
$replyview=0;
}

//$title=strip_tags($_POST['title']);
$title=$_POST['title'];
$title=htmlentities($title, ENT_QUOTES,gb2312);
$title=str_replace("\r\n","",$title);
$title=addslashes($title);

//$content=strip_tags($_POST['message'],"<b>");
$content=$_POST['message'];
$content=htmlentities($content, ENT_QUOTES,gb2312);
$content=str_replace("\r\n","<br />",$content); 
$content=addslashes($content);

include 'include/replace.php';//������˹��˴��ﴦ��

include 'include/ubb.php';//����UBB����

$ip=$_SERVER['REMOTE_ADDR']; 
$lastlogname=$firstlogname=$_SESSION['logname'];


$regtime=$row9[regtime];
$hp=$row9[hp];
$pp=$row9[pp];
$sign=$row9[sign];
$lastnkname=$firstnickname=$row9[nickname];
$zts=$row9[zts]+1;
$hfs=$row9[hfs];
$face=$row9[face];
$area=$row9[area];


$sql="INSERT INTO `{$fkduo}zhuti` (`title`,`content`,`bk`,`firstlogname`,`firstnkname`,`firsttime`,`ip`,`lastnkname`,`lastlogname`,`lasttime`,`pic`,`img`,`regtime`,`hp`,`pp`,`area`,`sign`,`through`,`zts`,`hfs`,`face`,`sort`,`replyview`) VALUES ('$title','$content','$bk','$firstlogname','$firstnickname','$firsttime','$ip','$lastnkname','$lastlogname','$lasttime','$pic','$img','$regtime','$hp','$pp','$area','$sign','$through','$zts','$hfs','$face','$sort','$replyview')";
$query=mysql_query($sql);//��������
$cid=mysql_insert_id();

$sql2="update `{$fkduo}user` set `zts`=`zts`+1,`lastft`='$lasttime' where (`logname`='$firstlogname')";
$query2=mysql_query($sql2);//�����û�������


$eee="postalert.php?action=lz&cid=".$cid."&bk=".$bk;
header ("location: $eee"); 

?>
