<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
</head>

<body>

<?
include 'check.php';
if (empty($_GET[step])){
?>

<form id="form1" name="form1" method="post" action="userinfo.php?step=2">
  <table width="412" height="110" border="1">
    <tr>
      <td height="44" colspan="3">�޸��û���Ϣ</td>
    </tr>
    <tr>
      <td>�û���</td>
      <td><label>
        <input type="text" name="logname" />
      </label></td>
      <td><label>
        <input type="submit" name="Submit2" value=" �� �� " />
      </label></td>
    </tr>
  </table>
</form>



<?
exit;
}elseif ($_GET[step]==2)
{
$logname=ruku($_POST[logname]);

$sql="select * from {$fkduo}user where `logname`='$logname' limit 1";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu<1){
echo "<font color=red>�Ҳ������û���</font>";
exit;
}

function uuuw($mkktime){ //ʱ��ת����ʽ
$mkktime=date("Y-m-d H:i",$mkktime);
return $mkktime;  
}

$row=mysql_fetch_array($query);

?>


<form id="form1" name="form1" method="post" action="userinfo.php?step=3&logname=<? echo $logname?>">
<table width="439" height="427" border="1">
  <tr>
    <td colspan="2">�޸��û���Ϣ</td>
  </tr>
  <tr>
    <td>�û���</td>
    <td><? echo $row[logname] ?></td>
  </tr>
  <tr>
    <td>�س�</td>
    <td>
	<input name="nickname" type="text" id="nickname" value="<? echo $row[nickname] ?>" />	</td>
  </tr>
  <? if ($row[face]==0){?>
  <tr>
    <td>ͷ��</td>
    <td><img src="<? echo "../html/face/".$row[logname].".".$row[face] ?>" border="0" />
      <label>
      <input name="delface" type="checkbox" id="delface" value="1" />
      ɾ��ͷ��</label></td>
  </tr>
  <? } ?>
  <tr>
    <td>HP</td>
    <td>
	<input name="hp" type="text" id="hp" value="<? echo $row[hp] ?>" />	</td>
  </tr>
  <tr>
    <td>PP</td>
    <td>
	<input name="pp" type="text" id="pp" value="<? echo $row[pp] ?>" />	</td>
  </tr>
  <tr>
    <td>����</td>
    <td><input name="zts" type="text" id="zts" value="<? echo $row[zts] ?>" size="6" />
    +<input name="hfs" type="text" id="hfs" value="<? echo $row[hfs] ?>" size="6" /></td>
  </tr>
  
    <tr>
    <td>����</td>
    <td><input name="area" type="text" id="area" value="<? echo $row[area] ?>" size="10" />
	</td>
  </tr>
  
    <tr>
    <td>ע��ʱ��</td>
    <td>
	<input name="regtime" type="text" id="regtime" value="<? echo uuuw($row[regtime]) ?>" />
	</td>
  </tr>
  
    <tr>
    <td>ǩ��</td>
    <td>
	<label>
	<textarea name="sign" cols="30" rows="6"><? echo $row[sign] ?></textarea>
	</label>	</td>
  </tr>
  
  
  <tr>
    <td>�û����</td>
    <td><? echo $row[uid] ?></td>
  </tr>
  <tr>
    <td colspan="2">
	<center>
      <input type="submit" name="Submit" value="�� �� �� ��" />
    </center></td>
    </tr>
</table>        
</form>

<?
}elseif ($_GET[step]==3)
{
$logname=ruku($_GET[logname]);
$nickname=ruku($_POST[nickname]);
$hp=ruku($_POST[hp]);
$pp=ruku($_POST[pp]);
$zts=ruku($_POST[zts]);
$hfs=ruku($_POST[hfs]);
$area=ruku($_POST[area]);
$sign=ruku($_POST[sign]);
$regtime=strtotime(ruku($_POST[regtime]));

if ($_POST[delface]==1){
$sql="update `{$fkduo}user` set `nickname`='$nickname',`hp`='$hp',`pp`='$pp',`zts`='$zts',`hfs`='$hfs',`face`='1',`area`='$area',`sign`='$sign',`regtime`='$regtime' where (`logname`='$logname') limit 1";
}else
{
$sql="update `{$fkduo}user` set `nickname`='$nickname',`hp`='$hp',`pp`='$pp',`zts`='$zts',`hfs`='$hfs',`area`='$area',`sign`='$sign',`regtime`='$regtime' where (`logname`='$logname') limit 1";
}


$query=mysql_query($sql) or die("���³�����!!!");//�����û���Ϣ

echo "�޸ĳɹ�";
}
?>
</body>
</html>
