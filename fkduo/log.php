<? 
include '../conn.php';

if ($_SESSION[power]>3){
echo "<font color=red>�����صأ����������</font>";
exit;
}


if (empty($_SESSION[logname])){
echo "���ȴ�ǰ̨��½��";
exit;
}



switch ($_GET[action]){
case log:
$logname=addslashes($_POST[logname]);
$password=$_POST[password];

$sql="select * FROM `{$fkduo}fkduo` where (logname='$logname')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
$row=mysql_fetch_array($query);
$salt=$row[salt];

if ($jilu==0 or $_SESSION[logname]!=$logname){
echo "<font color=red>�û������������</font>";
session_destroy();
exit;
}

$password=md5(md5($password).$salt);
if ($row[password]===$password) {
$_SESSION[power]='1';
header ("location: f.php");
}else
{
echo "<font color=red>�û������������</font>";
session_destroy();
exit;
}
break;

case out:
$_SESSION[power]=3;
echo "<font color=red>���Ѿ��ɹ��˳��߼�����״̬��</font>";
exit;
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
����Ա��½��
<form id="form1" name="form1" method="post" action="log.php?action=log">
  <label>�û���
  <input type="text" name="logname" tabindex="1" />
  </label>
  <p>
    <label>���� &nbsp;
    <input type="password" name="password" tabindex="2" />
    </label>
  </p>
  <p>
    <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="Submit" value="�ύ" tabindex="3" />
    </label>
  </p>
</form>
</body>
</html>
