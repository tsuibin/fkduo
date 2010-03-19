<? 
include 'check.php';

$lc=(int)($_GET[lc]);

switch ($_GET[action]){
case del:
mysql_query("DELETE FROM `{$fkduo}card` WHERE (`cid`='$cid' and `lc`='$lc')");
header ("location: checkhuifu.php");
break;

case pass:
$sql="update `{$fkduo}card` set `through`='0' where (`cid`='$cid' and `lc`='$lc') limit 1";
$query=mysql_query($sql);
header ("location: checkhuifu.php");
break;

default:
break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>无标题文档</title>
</head>

<body>

<?
$sql="select * FROM `{$fkduo}card` where `through`='1' order by `lasttime`";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#00CCFF">审核回帖,总共<font color=red><? echo $jilu ?></font>条</td>
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

echo "回复时间:".uuuw($row[lasttime])."<br>";
echo "回复内容:".$row[content]."<br>";
echo "<a href=checkhuifu.php?action=del&cid=".$row[cid]."&lc=".$row[lc].">删除</a>&nbsp;&nbsp;<a href=checkhuifu.php?action=pass&cid=".$row[cid]."&lc=".$row[lc].">通过</a><br>";
if (!$row[pic]==0){
echo "<img src=../".$row[pic].">";
}
echo "<br><hr><br>";
?></td>
  </tr><? }?>
</table>
</body>
</html>
