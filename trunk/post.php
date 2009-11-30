<? 
include 'conn.php';
include 'check.php' ;

if ($_SESSION[lock]==1){
$tis= "对不起，你的账号处于冻结期，无法发贴！";
tis($tis);
exit;
}

$filename="template/listtop{$_GET['bk']}.html";
if (!file_exists($filename)) {
$tis= "版块参数错误，或者相关模板文件不存在！";
tis($tis);
exit;
} 


$query=mysql_query("select * FROM `{$fkduo}sort` where `bk`='$bk' ");

$listtop="listtop".$bk;//文件名
$cid=1;//假的CID


include 'xingTemplate.php';
$xingTemplate->display('post');
?>