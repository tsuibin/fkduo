<?
include 'check.php';

switch ($_GET[action]){
case add:
$bk=$_POST[bkid];
$name=$_POST[name];

$query=mysql_query("INSERT INTO `{$fkduo}sort` (`name`,`bk`) VALUES ('$name','$bk')");//������־
$eee="sortadd.php?action=ok";
header ("location: $eee"); 
break;

case ok:
echo "<font color=red>����������ӳɹ�!</fotn><br><br>";
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

      <form id="form1" name="form1" method="post" action="sortadd.php?action=add">

<table width="36%" height="108" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#9999FF">��ӻ������</td>
    <td bgcolor="#9999FF"></td>
    <td bgcolor="#9999FF"></td>
  </tr>
  
  
  <tr>
    <td>ѡ���飺</td>
    <td>
	<select name="bkid" accesskey="1" >
<?
$sql="select * FROM `{$fkduo}bk` ORDER by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
<option value="<? echo $row[bkid] ?>" selected="selected"><? echo $row[bkname] ?></option>
<?
}
?>
</select>
	
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>�������</td>
    <td><label>
          <input type="text" name="name" accesskey="2" />
        </label>    </td>
    <td><label>
      <input type="submit" name="Submit" value="�� ��" accesskey="3" />
      </label></td>
  </tr>
</table>      </form>
  <a href="sortdel.php" target="main">�������ɾ��</a><br />
</body>
</html>
