<?
$yanc=1;
include 'conn.php';
include 'check.php' ;

$_POST['message']=trim($_POST['message']);

if (empty($_POST['message']) or empty($_GET['cid'])) {
$tis= "�������󣬻�ظ����ݲ���Ϊ�գ��������ҳ����в���"; 
tis($tis);
exit;
}

$favtime=$lasttime=mktime();

$query9=mysql_query("select * FROM `{$fkduo}user` where `logname`='$_SESSION[logname]' limit 1");
$row9=mysql_fetch_array($query9) ;
if ($row9[lock]==1){
$tis="�Բ�������˺Ŵ��ڶ����ڣ��޷�������";
tis($tis);
exit;
}

if (($lasttime-$row9[lastft])<$ftime){
$tis="�Բ�����ķ������ʱ������".$ftime."�룡";
tis($tis);
exit;
}


$sql2="select * FROM `{$fkduo}zhuti` where (cid='$cid') limit 1";
$query2=mysql_query($sql2);
$row2=mysql_fetch_array($query2);
$lcnow=$row2[huifu]+1;//jump��
$lc=$row2[huifuall]+1;
$favtitle=$row2[title];//�����ղ���

if ($row2[lock]==1)
{
$tis= "��������������ʱ�����Իظ���";
tis($tis);
exit;
}


if (is_uploaded_file($_FILES["upfile"][tmp_name]))//�Ƿ����ϴ��ļ�Ҫ����
{

if ($_SESSION[picallow]<1){

$tis="������ķ�ͼ��������꣡";
tis($tis);
exit;
}

$smallmark = 2;//����������ͼ
include 'up.php';
}else
{
$img=0;
}

//$content=strip_tags($_POST['message'],"<b>");//

$content=$_POST['message'];
$content=htmlentities($content, ENT_QUOTES,gb2312);
$content=str_replace("\r\n","<br />",$content);  
$content=addslashes($content);
include 'include/ubb.php';
include 'include/replace.php';//������˹��˴��ﴦ��

$ip=$_SERVER['REMOTE_ADDR']; 

$lastlogname=$_SESSION[logname];


$regtime=$row9[regtime];
$hp=$row9[hp];
$pp=$row9[pp];
$favcount=$row9[favcount];//�ղ�����
$lastnkname=$row9[nickname];
$sign=$row9[sign];
$zts=$row9[zts];
$hfs=$row9[hfs]+1;
$face=$row9[face];
$area=$row9[area];

$tis="�����ˣ��ظ����ɹ�������ϵ����Ա��";
$sql="INSERT INTO `{$fkduo}card` (`content`,`bk`,`lastlogname`,`lastnkname`,`lasttime`,`pic`,`ip`,`cid`,`lc`,`regtime`,`hp`,`pp`,`area`,`sign`,`through`,`zts`,`hfs`,`face`) VALUES ('$content','$bk','$lastlogname','$lastnkname','$lasttime','$pic','$ip','$cid','$lc','$regtime','$hp','$pp','$area','$sign','$through','$zts','$hfs','$face')";
$query=mysql_query($sql) or die(tis($tis));//������־

$sql2="update `{$fkduo}user` set `hfs`=`hfs`+1,`lastft`='$lasttime' where (`logname`='$lastlogname') limit 1";
$query2=mysql_query($sql2);//�����û���������


$sql3="update `{$fkduo}zhuti` set `huifu`=`huifu`+1,`huifuall`=`huifuall`+1,`lasttime`='$lasttime',`lastnkname`='$lastnkname',`lastlogname`='$lastlogname' where (`cid`='$cid') limit 1";
$query3=mysql_query($sql3);//��������ظ�����Ϣ



if ($_POST['checkbox']==checkbox){

$sql2="select * from `{$fkduo}fav` where (cid='$cid' and favuser='$lastlogname')";
$rowu=mysql_num_rows(mysql_query($sql2));
if ($rowu==0){

if ($favcount>10){
$tis= "���ӻظ��ɹ������������ղؼ�����������ɾ�������ղ��ٽ��в�����";
tis($tis);
exit(); }
else{
$sql="INSERT INTO `{$fkduo}fav` (`cid`,`title`,`bk`,`favuser`,`favtime`) VALUES ('$cid', '$favtitle', '$bk', '$lastlogname', '$lasttime')";
$query=mysql_query($sql);

$sql2="update `{$fkduo}user` set `favcount`=`favcount`+1 where (`logname`='$lastlogname') limit 1";
$query2=mysql_query($sql2);//�����û��ղؼ�����

$sql2="update `{$fkduo}zhuti` set `favcount`=`favcount`+1 where (`cid`='$cid') limit 1";
mysql_query($sql2); }
}
else
{
$tis= "���ӻظ�<font color=red>�ɹ�</font>�����ղ�<font color=red>���ɹ�</font>����Ϊ���Ѿ��ղع�������";
tis($tis);
exit();
}


}


if ($lcnow<$contentstep){ //��ظ���Ҫ���ص�ҳ��
$now=1;
}
elseif($lcnow%$contentstep==0)
{
$now=(int)($lcnow/$contentstep);
}elseif($lcnow%$contentstep>0)
{
$now=(int)($lcnow/$contentstep)+1;
}



$eee="postalert.php?action=huifu&cid=".$cid."&bk=".$bk."&now=".$now."&pid=".$lc;
header ("location: $eee"); 
?>