<?
include 'check.php';

$oldw=$_POST[oldw];
$id=(int)($_GET[id]);

switch ($_GET[action]){
case add:
$query=mysql_query("INSERT INTO `{$fkduo}replace` (`oldw`,`type`) VALUES ('$oldw','2')");//������־
$bkid=mysql_insert_id();
$eee="replace2.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>�����ɹ���</font>";
break;

case del:
mysql_query("DELETE FROM `{$fkduo}replace` WHERE `id`='$id'");
$eee="replace2.php?action=ok";
header ("location: $eee"); 
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
<h2>����תΪ��̨��˵Ĵ��</h2>
(˵��:�������к������´���ʱ���Զ�ת����̨���)
<table width="44%" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#99CC99">����</td>
    <td bgcolor="#99CC99"></td>
  </tr>
  <?
$sql="select * FROM `{$fkduo}replace` where `type`='2' ORDER by `id`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
    <tr>
      <td><? echo $row[oldw] ?></td>
      <td><a href="replace2.php?action=del&id=<? echo $row[id] ?>">ɾ��</a></td>
    </tr>
  <?
  }
  ?>
</table>


<form id="form1" name="form1" method="post" action="replace2.php?action=add">
  <label>���
  <input name="oldw" type="text" id="oldw" accesskey="1" />
  </label>
  <label>
  <input type="submit" name="Submit" value="���" accesskey="3" />
  </label>
</form>

<br /><br />
��ע�⣺������˴ʻ�Ӱ�췢���ٶȡ�

</body>
</html>