<? 
include 'check.php';

$lc=(int)($_GET[lc]);

switch ($_GET[action]){
case del:
$query=mysql_query("select * FROM `{$fkduo}zhuti` where `cid`='$cid' limit 1");
$row=mysql_fetch_array($query);
if ($row[pic]!="0"){
$dirr=substr(getcwd(),0, -5).$row[pic];
unlink($dirr);}//删除附件

mysql_query("DELETE FROM `{$fkduo}zhuti` WHERE (`cid`='$cid') limit 1") or die ("删除出错了!");
mysql_query("DELETE FROM `{$fkduo}card` WHERE (`cid`='$cid')") or die ("删除出错了!");
header ("location: hsz.php");
break;

case pass:
mysql_query("update `{$fkduo}zhuti` set `hs`='0' where (`cid`='$cid') limit 1");
mysql_query("update `{$fkduo}card` set `hs`='0' where (`cid`='$cid')");
header ("location: hsz.php");
break;

default:
break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<body>

<?
$sql="select * FROM `{$fkduo}zhuti` where `hs`='1' order by `lasttime` DESC limit 200";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#00CCFF">回收站,总共<font color=red><? echo $jilu ?></font>条主题</td>
  </tr>
<?
function uuuw($mkktime){
//$mkktime=(int)($mkktime);
$mkktime=date("09-m-d H:i:s",$mkktime);
return $mkktime;
}
while ($row=mysql_fetch_array($query)){
?>
  <tr>
    <td>
	<?

//echo "回复时间:".uuuw($row[lasttime])."<br>";
echo "<a href=../loop2hs.php?cid=".$row[cid]."&bk=".$row[bk]." target=_blank>".$row[title]."<br>";
echo "<a href=hsz.php?action=del&cid=".$row[cid].">彻底删除</a>&nbsp;&nbsp;<a href=hsz.php?action=pass&cid=".$row[cid].">恢复帖子</a>";
if (!$row[pic]==0){
echo "<img src=../".$row[pic].">";
}
echo "<hr>";
?></td>
  </tr><? }?>
</table>
</body>
</html>
