<?
include 'check.php';

$oldw=$_POST[oldw];
$neww=$_POST[neww];
$id=(int)($_GET[id]);

switch ($_GET[action]){
case add:
$query=mysql_query("INSERT INTO `{$fkduo}replace` (`oldw`,`neww`,`type`) VALUES ('$oldw','$neww','3')");//������־
$bkid=mysql_insert_id();
$eee="replace3.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>�����ɹ���</font>";
break;

case del:
mysql_query("DELETE FROM `{$fkduo}replace` WHERE `id`='$id'");
$eee="replace3.php?action=ok";
header ("location: $eee"); 
break;

default:
break;

}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>�ޱ����ĵ�</title>
</head>

<body>
<h2>���ô����滻��</h2>
(˵��:�����������к���"����1"�������滻����Ӧ��"����2")
<table width="44%" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#99CC99">����1</td>
	<td bgcolor="#99CC99">����2</td>
    <td bgcolor="#99CC99"></td>
  </tr>
  <?
$sql="select * FROM `{$fkduo}replace` where `type`='3' ORDER by `id`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
    <tr>
      <td><? echo $row[oldw] ?></td>
	  <td><? echo $row[neww] ?></td>
      <td><a href="replace3.php?action=del&id=<? echo $row[id] ?>">ɾ��</a></td>
    </tr>
  <?
  }
  ?>
  </table><br><br>
  <table>
    <tr>
    <td bgcolor="#99CC99">����1</td>
	<td bgcolor="#99CC99">����2</td>
    <td></td>
  </tr>
  
  <form id="form1" name="form1" method="post" action="replace3.php?action=add">
    <tr>
    <td><input name="oldw" type="text" id="oldw" accesskey="1" /></td>
	<td><input name="neww" type="text" id="neww" accesskey="2" /></td>
    <td><input type="submit" name="Submit" value="���" accesskey="3" /></td>
  </tr>
  </form>
</table>

<br /><br />
��ע�⣺������˴ʻ�Ӱ�췢���ٶȡ�
</body>
</html>