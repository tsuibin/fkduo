<? 
include 'check.php';

switch ($_GET[action]){
case mod:
$bkname=$_POST[bkname];
$bkjj=$_POST[bkjj];
$px=(int)($_POST[px]);
$bkid=$_GET[bkid];
$sql="update `{$fkduo}bk` set `bkname`='$bkname',`bkjj`='$bkjj',`px`='$px' where (`bkid`='$bkid') limit 1";
$query=mysql_query($sql);

$eee="bkmod.php?action=ok&bkid=".$bkid;
header ("location: $eee"); 
break;

case ok:

echo "�޸ĳɹ�����԰��id:<font color=red>".$_GET[bkid]."</font><br><br>";
$eee="../make.php?action=head";
echo "<iframe src=".$eee." width=\"300\" height=\"30\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\"></iframe>";

break;

default:
break;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
</head>

<body>


<table width="59%" height="71" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>ID:</td>
    <td>�������</td>
    <td>�����</td>
    <td>�������(С����ǰ)</td>
	<td>&nbsp;</td>
  </tr>
<?
$sql="select * FROM `{$fkduo}bk` ORDER by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
  <form id="form<? echo $row[bkid] ?>" name="form<? echo $row[bkid] ?>" method="post" action="bkmod.php?action=mod&bkid=<? echo $row[bkid] ?>">
  <tr>
    <td><font color=red><? echo $row[bkid] ?></font></td>
    <td><input name="bkname" type="text" id="bkname" value="<? echo $row[bkname] ?>" /></td>
    <td><input name="bkjj" type="text" id="bkjj" value="<? echo $row[bkjj] ?>" /></td>
    <td><input name="px" type="text" id="px" value="<? echo $row[px] ?>" /></td>
	<td><input type="submit" name="Submit<? $row[id] ?>" value="�� ��" /></td>
  </tr>
  </form>
  
  
  <?
  }
  


  ?>
</table>

</body>
</html>
