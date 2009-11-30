<? 
include 'check.php';

switch ($_GET[action]){
case del:
$bkid=$_GET[bkid];
mysql_query("DELETE FROM `{$fkduo}bk` WHERE `bkid`='$bkid'");//删除版块

$doo=(int)($_POST[checkbox]);//删除帖子数据
if ($doo==95){
mysql_query("DELETE FROM `{$fkduo}zhuti` WHERE `bk`='$bkid'");
mysql_query("DELETE FROM `{$fkduo}card` WHERE `bk`='$bkid'");
}

$eee="bkdel.php?action=ok&bkid=".$bkid;
header ("location: $eee"); 
break;

case ok:
echo "删除成功，针对版块id:<font color=red>".$_GET[bkid]."</font><br><br>";
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
<title>无标题文档</title>
</head>

<body>
<table width="54%" height="70" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <h1>版块删除</h1>
  </tr>
  <tr>
    <td width="6%" bgcolor="#99CC99">ID:</td>
    <td width="22%" bgcolor="#99CC99">版块名称</td>
    <td width="40%" bgcolor="#99CC99">同时删除旗下帖子</td>
    <td width="32%" bgcolor="#99CC99"></td>
  </tr>
  <?
$sql="select * FROM `{$fkduo}bk` ORDER by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
?>
  <form id="form<? echo $row[bkid] ?>" name="form<? echo $row[bkid] ?>" method="post" action="bkdel.php?action=del&bkid=<? echo $row[bkid] ?>">
    <tr>
      <td><font color=red><? echo $row[bkid] ?></font></td>
      <td><? echo $row[bkname] ?></td>
      <td><div align="center">
        <input type="checkbox" name="checkbox" value="95" />
      </div></td>
      <td><input type="submit" name="Submit<? $row[id] ?>" value="删 除" /></td>
    </tr>
  </form>
  <?
  }
  ?>
</table>
</body>
</html>
