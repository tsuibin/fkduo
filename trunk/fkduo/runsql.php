<?php 
include 'check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
</head>

<body><br /><br />
<?
$sqlcode=stripcslashes($_POST[sql]);
$sqlcode=str_replace('{$fkduo}', $fkduo, $sqlcode);

if (!empty($sqlcode)){
mysql_query($sqlcode) or die("<font color=red>����������ִ�в��ɹ���</font>");//������־
echo "�����ɹ�������";
exit;
}
?>
<center>�������ݿ⣬ִ��SQL��䣨��������У���
<form id="form1" name="form1" method="post" action="runsql.php">
  <label>
  <textarea name="sql" cols="50" rows="12"></textarea>
  </label>
  <p>
    <label>
    <input type="submit" name="Submit" value=" �� �� " />
    </label>
  </p>
</form>
</center>
</body>
</html>
