<?
include 'check.php';

$id=(int)($_GET[id]);

switch ($_GET[action]){
case del:
mysql_query("DELETE FROM `{$fkduo}report` WHERE (`id`='$id')");
header ("location: report.php");
break;

default:
break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�a</title>
</head>

<body>

<?
$sql="select * FROM `{$fkduo}report` order by `id` DESC limit 200";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
?>
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#00CCFF">�ٱ��б�,�ܹ�<font color=red><? echo $jilu ?></font>������</td>
  </tr>
<?
function uuuw($mkktime){
$mkktime=date("09-m-d H:i:s",$mkktime);
return $mkktime;
}
while ($row=mysql_fetch_array($query)){
?>
  <tr>
    <td>
	<?
echo $row[from]."�ٱ�:<a href=../".stripcslashes($row[url])." target=_blank>".stripcslashes($row[url])."</a>&nbsp;".$row[why2]."<br>";
echo "�ٱ�ʱ�䣺".uuuw($row[time]);
echo "<a href=report.php?action=del&id=".$row[id]."><br>ɾ���˾ٱ���¼</a>";
echo "<hr>";
?></td>
  </tr><? }?>
</table>
</body>
</html>
