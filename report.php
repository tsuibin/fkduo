<?
include 'conn.php';
$now=$_GET['now'];

switch ($_GET['action']) {
case report;
$url=addslashes($_POST['url']);
$why=(int)($_POST['error_type']);
$why2=addslashes($_POST['content']);//
$from=$_SESSION[logname];
$time=mktime();
$sql="INSERT INTO `{$fkduo}report` (`url`,`why`,`why2`,`from`,`time`) VALUES ('$url','$why','$why2','$from','$time')";
$query=mysql_query($sql);
header ("location: report.php?action=ok"); 
break;

case ok:
echo "感谢您的报告，我们会尽快处理！您现在可以关闭本页面。";
exit;

default;
break;
}

$url="loop2.php?bk=".$bk."&cid=".$cid."&now=".$now."#pid".$_GET['lc'];

include 'xingTemplate.php';

$xingTemplate->display('report');



?>