<?
include 'check.php';
if (empty($_GET[step])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>�ޱ����ĵ�</title>
</head>

<body>


<form id="form1" name="form1" method="post" action="sign.php?step=2">
<p>�����޸��û�����ǩ����</p>
<p>�û�����</p>

  <label>
  <input type="text" name="logname" />
  </label>

<p>�滻ǩ��(����ֱ�����)��</p>
<p>
  <label>
  <textarea name="sign" cols="40" rows="7">��һ������û��дǩ��!</textarea>
  </label>
</p>
<p>���ޣ�
  <label>
  <input name="howtime" type="radio" value="3" checked="checked" />
  ������</label>
  <label>
  <input type="radio" name="howtime" value="7" />
һ����</label>
  <label>
  <input type="radio" name="howtime" value="30" />
  һ����</label>
  <label>
  <input type="radio" name="howtime" value="0" />
  ����ʱ��
  </label>
</p>
<p>
  <label>
  <input type="submit" name="Submit" value="�޸�" />
  </label>
</p>
</form>

<?
}elseif ($_GET[step]==2){
$logname=ruku($_POST[logname]);
$sign=ruku($_POST[sign]);
$how=$howtime=(int)($_POST[howtime]);
$timenow=mktime();

$sql="select * from {$fkduo}user where `logname`='$logname' limit 1";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu==0){
echo "û������û�";
echo "[ <a href=\"javascript:history.back(1)\" ><font color=\"blue\">����</font></a> ]";
exit;
}


if ($howtime==0){
mysql_query("update `{$fkduo}zhuti` set `sign`='$sign' where (`firstlogname`='$logname')") or die("������") ;
mysql_query("update `{$fkduo}card` set `sign`='$sign' where (`lastlogname`='$logname')") or die("������");

echo "�û�:".$logname."����ʱ���ǩ�����³ɹ���";
}else
{
$howtime=$timenow-($howtime*86400);

mysql_query("update `{$fkduo}zhuti` set `sign`='$sign' where `firstlogname`='$logname' and `firsttime` between '$howtime' and '$timenow'") or die("������");
mysql_query("update `{$fkduo}card` set `sign`='$sign' where `lastlogname`='$logname' and `lasttime` between '$howtime' and '$timenow'") or die("������");

echo "�û�:".$logname.$how."���ڵ�ǩ�����³ɹ���";
}
}
?>
</body>
</html>