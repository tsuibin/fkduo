<?
include 'conn.php';
include 'tis.php';

if ($_SESSION[lock]==1){
$tis= "�Բ�������˺Ŵ��ڶ����ڣ��޷��༭��";
tis($tis);
exit;
}

if (empty($_SESSION[logname])){
$tis= "�Բ������ȵ�½��";
tis($tis);
exit;
}

$filename="template/listtop{$_GET['bk']}.html";
if (!file_exists($filename)) {
$tis= "���������󣬻������ģ���ļ������ڣ�";
tis($tis);
exit;
} 

$lc=(int)($_GET['lc']);
$listtop="listtop".$bk;

switch ($_GET['action']){
case lz;
$sql="select * from `{$fkduo}zhuti` where (`cid`='$cid' and `hs`='0') limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);

if ($_SESSION[power]>3){
if ($row[pb]==1){
$tis= "���ӱ����Σ��޷��޸ģ�";
tis($tis);
exit;
}

if (!($row[firstlogname]==$_SESSION[logname]))
{
$tis= "��û�е�½��û��Ȩ�ޱ༭�˼ҵ����ӣ�";
tis($tis);
exit;
}

if ($row[edits]>=$_SESSION[ppallow]){
$tis= "<b>�Ѿ������Ա༭�ˣ��㵱ǰ�ĵȼ���һ������ֻ�ܱ༭<font color=red>".$_SESSION[ppallow]."</font>�Σ�</b>";
tis($tis);
exit;
}
}
break;


case huifu;
$sql="select * from `{$fkduo}card` where (`cid`='$cid' and `hs`='0' and `lc`='$lc' ) limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);

if ($_SESSION[power]>3){
if ($row[pb]==1){
$tis= "���ӱ����Σ��޷��޸ģ�";
tis($tis);
exit;
}

if (!($row[lastlogname]==$_SESSION[logname]))
{
$tis= "��û�е�½��û��Ȩ�ޱ༭�˼ҵ����ӣ�";
tis($tis);
exit;
}

if ($row[edits]>=$_SESSION[ppallow]){
$tis= "<b>�Ѿ������Ա༭�ˣ��㵱ǰ�ĵȼ���һ������ֻ�ܱ༭<font color=red>".$_SESSION[ppallow]."</font>�Σ�</b>";
tis($tis);
exit;
}
}
break;

default;
break;
}


$str=stripcslashes($row[content]);
$str1=stripcslashes($row[title]);



   $str = preg_replace("/\<img[^>]+src=\"html\/ico\/ico(\d{1,2})\.gif\"[^>]+\/>/i","{\\1}",$str); 
$str=preg_replace("/\<center><table border=\"0\" width=\"90%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#CCCCCC\"><tr><td bgcolor=\"#F0F0F0\">(.*?)<\/td><\/tr><\/table><\/center>/i","[quote]$1[/quote]",$str);   
   $str = preg_replace("/\<([\/]?)br(.*?)\>/i","\n",$str); 
   $str = preg_replace("/\<([\/]?)b(.*?)\>/i","[$1b]",$str);     
   $str=preg_replace("/\<a[^>]+href=\"(.+?)\" target=\"_blank\">(.+?)<\/a>/i","[url=$1]$2[/url]",$str); 
   $str = preg_replace("/\<a href=\"(.*)\" target=_blank><img src=\"(.*)\" alt=\"(.*)\" onload=\"if\(this.width>600\) {this.width=600;}\" \/><\/a>/i","[img]$1[/img]",$str); 
   
   //$str = preg_replace("/\<img[^>]+src=\"([^\"]+)\"[^>]*\>/i","[img]$1[/img]",$str); 
$str=preg_replace("/\<embed src=\"(.*)\" quality=\"high\" width=\"480\" height=\"400\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application\/x-shockwave-flash\"><\/embed>/i","[flash]$1[/flash]",$str);

      
   
include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('edit');
?>