<?
include 'conn.php';
include 'tis.php';

if ($_SESSION[lock]==1){
	$tis= "对不起，你的账号处于冻结期，无法编辑！";
	tis($tis);
	exit;
}

if (empty($_SESSION[logname])){
	$tis= "对不起，请先登陆！";
	tis($tis);
	exit;
}

$filename="template/listtop{$_GET['bk']}.html";
if (!file_exists($filename)) {
	$tis= "版块参数错误，或者相关模板文件不存在！";
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
			$tis= "帖子被屏蔽，无法修改！";
			tis($tis);
			exit;
		}

		if (!($row[firstlogname]==$_SESSION[logname]))
		{
			$tis= "你没有登陆或没有权限编辑人家的帖子！";
			tis($tis);
			exit;
		}

		if ($row[edits]>=$_SESSION[ppallow]){
			$tis= "<b>已经不可以编辑了，你当前的等级对一个贴子只能编辑<font color=red>".$_SESSION[ppallow]."</font>次！</b>";
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
			$tis= "帖子被屏蔽，无法修改！";
			tis($tis);
			exit;
		}

		if (!($row[lastlogname]==$_SESSION[logname]))
		{
			$tis= "你没有登陆或没有权限编辑人家的帖子！";
			tis($tis);
			exit;
		}

		if ($row[edits]>=$_SESSION[ppallow]){
			$tis= "<b>已经不可以编辑了，你当前的等级对一个贴子只能编辑<font color=red>".$_SESSION[ppallow]."</font>次！</b>";
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