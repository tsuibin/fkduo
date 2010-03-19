<? include 'check.php'; ?>
<?

switch ($_GET[action]){
case add:
$str= <<< EOT
<?
\$ad0="$_POST[ad0]";
\$ad1="$_POST[ad1]";
\$ad2="$_POST[ad2]";
\$ad3="$_POST[ad3]";
\$ad4="$_POST[ad4]";
?>
EOT;

  $he="../config/ads.php";
  $handle=fopen($he,"w"); //写入方式打开新闻路径
  fwrite($handle,$str); //把刚才替换的内容写进生成的HTML文件
  fclose($handle);
  header ("location: ads.php");
exit;

default:
break;
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>无标题文档</title>
</head>

<body>
<?
if(file_exists("../config/ads.php")){
include '../config/ads.php';
} 

?>
<center>
<form id="form1" name="form1" method="post" action="ads.php?action=add">
  <label>顶部通栏广告位(ad1)<br />
  <textarea name="ad0" cols="50" rows="8" id="ad0"><? echo $ad0 ?></textarea>
  </label><br />
  <label>右侧人气排行上方广告位(ad1宽130)<br />
  <textarea name="ad1" cols="50" rows="8" id="ad1"><? echo $ad1 ?></textarea>
  </label><br />
  <label>底部通栏广告位(ad2)<br />
  <textarea name="ad2" cols="50" rows="8" id="ad2"><? echo $ad2 ?></textarea>
  </label><br />
  <label>网站统计(ad3)<br />
  <textarea name="ad3" cols="50" rows="8" id="ad3"><? echo $ad3 ?></textarea>
  </label><br />
  <label>贴间文字广告(ad4)<br />
  <textarea name="ad4" cols="50" rows="8" id="ad4"><? echo $ad4 ?></textarea>
  </label>

  <p>
    <input type="submit" name="Submit" value="提     交" />
  </p>
  <p>&nbsp;</p>
</form></center>
</body>
</html>
