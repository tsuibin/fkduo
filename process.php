<?
include 'conn.php';
include 'tis.php';

if (($_SESSION[power]>3) or ($_SESSION[power]<1)){
echo "<font color=red>�����صأ����������</font>";
exit;
}

if ($_SESSION[power]==3){//�����͹���Ա����
$query=mysql_query("select * from {$fkduo}bkmaster where `bkid`='$bk' and `uid`='$_SESSION[logname]'");
$jilu=mysql_num_rows($query);
if ($jilu==0){
$tis="����ʧ��,�㲻�������İ���!<br>������ǹ���Ա��������Ϊ����Ա!";
tis($tis);
exit;
}}


function tj($cid,$bk,$fkduo) { //�Ƽ�������������
$tj=(int)($_GET['tj']);
if ($tj=='1'){
$sql="update `{$fkduo}zhuti` set `tj`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //

$eee="make.php?action=right";
header ("location: $eee"); 
}else
{
$sql="update `{$fkduo}zhuti` set `tj`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
$eee="make.php?action=right";
header ("location: $eee"); 
}
}


function zd($cid,$bk,$fkduo) { //�ö�������������

$zd=(int)($_GET['zd']);
if ($zd=='1'){
$sql="update `{$fkduo}zhuti` set `zd`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
$eee="make.php?action=listtop&bk=".$bk;
header ("location: $eee"); 
}else
{
$sql="update `{$fkduo}zhuti` set `zd`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //

$eee="make.php?action=listtop&bk=".$bk;
header ("location: $eee"); 
}
}

function jh($cid,$fkduo) { //����������������
$jh=(int)($_GET['jh']);
if ($jh=='1'){
$sql="update `{$fkduo}zhuti` set `jh`='1' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "<br>�����ɹ�<br><br>";
echo "<a href=process.php?action=jh&jh=2&cid=".$cid.">��˽������</a>";
}else
{
$sql="update `{$fkduo}zhuti` set `jh`='0' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "��������ɹ�";
}
exit;
}

function lock($cid,$fkduo) { //����������������
$lock=(int)($_GET['lock']);
if ($lock=='1'){
$sql="update `{$fkduo}zhuti` set `lock`='1' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "<br>�����ɹ�<br><br>";
echo "<a href=process.php?action=lock&lock=2&cid=".$cid.">��˽������</a>";

}else
{
$sql="update `{$fkduo}zhuti` set `lock`='0' where (`cid`='$cid') limit 1";
$query=mysql_query($sql); //
echo "��������ɹ�";
}
}

function pblz($cid,$bk,$fkduo) { //��������������������
$pb=(int)($_GET['pb']);
if ($pb=='1'){
$sql="update `{$fkduo}zhuti` set `pb`='1' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "<br>���γɹ�<br><br>";
echo "<a href=process.php?action=pblz&pb=2&cid=".$cid.">��˽������</a>";
}else
{
$sql="update `{$fkduo}zhuti` set `pb`='0' where (`cid`='$cid' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "������γɹ�";
}
}

function pbhuifu($cid,$bk,$fkduo) { //��������������������
$pb=(int)($_GET['pb']);
$lc=(int)($_GET['lc']);
if ($pb=='1'){
$sql="update `{$fkduo}card` set `pb`='1' where (`cid`='$cid' and `lc`='$lc' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "���γɹ�";
}else
{
$sql="update `{$fkduo}card` set `pb`='0' where (`cid`='$cid' and `lc`='$lc' and `bk`='$bk') limit 1";
$query=mysql_query($sql); //
echo "������γɹ�";
}
}


function hslz($cid,$fkduo) { //�������վ������������
$huifu=(int)($_GET['huifu']);
mysql_query("update `{$fkduo}zhuti` set `hs`='1' where (`cid`='$cid') limit 1"); //��������
if ($huifu>0){ mysql_query("update `{$fkduo}card` set `hs`='1' where (`cid`='$cid')");}//���ջ���
echo "���ӳɹ��������վ";
}


function delhuifu($cid,$fkduo) { //�ظ�ɾ��
$lc=(int)($_GET['lc']);
$query=mysql_query("select * FROM `{$fkduo}card` where (`cid`='$cid' and `lc`='$lc') limit 1");
$row=mysql_fetch_array($query);
if ($row[pic]!="0"){ unlink($row[pic]); }//ɾ������

mysql_query("DELETE FROM `{$fkduo}card` WHERE (`cid`='$cid' and `lc`='$lc') limit 1") or die ("ɾ��������!");
mysql_query("update `{$fkduo}zhuti` set `huifu`=`huifu`-1 where (`cid`='$cid') limit 1"); //��������ظ���

echo "���ӳɹ�ɾ�����������վ";
}


function highlight($cid,$mod,$fkduo){//����
if ($mod==1){
mysql_query("update `{$fkduo}zhuti` set `highlight`='1' where `cid`='$cid' limit 1") or die ("������"); //����
echo "<br >�����ɹ���!<br ><br >";
echo "<a href=process.php?action=highlight&mod=2&cid=".$cid.">��˽������</a>";
}else
{
mysql_query("update `{$fkduo}zhuti` set `highlight`='0' where `cid`='$cid' limit 1") or die ("������"); //��������
echo "ȡ�������ɹ�!";
}
exit;
}



switch($_GET['action'])
{
case 'tj':
       tj($cid,$bk,$fkduo);break;
case 'zd':
       zd($cid,$bk,$fkduo);break;
case 'jh':
       jh($cid,$fkduo);break;
case 'hslz':
       hslz($cid,$fkduo);break;
case 'lock':
       lock($cid,$fkduo);break;
case 'pblz':
       pblz($cid,$bk,$fkduo);break;
case 'pbhuifu':
       pbhuifu($cid,$bk,$fkduo);break;
case 'delhuifu':
       delhuifu($cid,$fkduo);break;	   
case 'highlight':
       highlight($cid,$_GET['mod'],$fkduo);break;
default:
       echo "�޲�����"; // 
}
?>