<? 
include 'check.php';
switch ($_GET[action]){
case del:
mysql_query("DELETE FROM `{$fkduo}zhuti` WHERE (`cid`='$cid')");
header ("location: checkzhuti.php");
break;

case pass:
$sql="update `{$fkduo}zhuti` set `through`='0' where (`cid`='$cid') limit 1";
$query=mysql_query($sql);
header ("location: checkzhuti.php");
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
<style type="text/css">
<!--
.aa {
	font-size: 14px;
}
-->
</style>
</head>

<body class="aa">

<?
$sql="select * FROM `{$fkduo}zhuti` where `through`='1' order by `firsttime`";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
?>
<table border="0">
  <tr>
    <td bgcolor="#00CCFF">审核主题帖子,总共<font color=red><? echo $jilu ?></font>条</td>
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
echo "帖子标题:".$row[title]."<br>";
echo "发贴时间:".uuuw($row[firsttime])."&nbsp;&nbsp;&nbsp;&nbsp;<a href=checkzhuti.php?action=del&cid=".$row[cid].">删除</a>&nbsp;&nbsp;<a href=checkzhuti.php?action=pass&cid=".$row[cid].">通过</a>";


   $row[content] = preg_replace("/\<([\/]?)br(.*?)\>/i","\n",$row[content]); // /b的
?>

<br>帖子内容:<br><textarea name="textarea" cols="70" rows="15"><? echo $row[content] ?></textarea>


<?
if (!$row[pic]==0){
echo "<img src=../".$row[pic].">";
}
echo "<br><hr><br>";
?></td>
  </tr><? }?>
</table>
</body>
</html>
