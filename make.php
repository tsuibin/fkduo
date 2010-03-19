<?
include 'conn.php';
include 'xingTemplate.php';

if (empty($_GET['action'])){
echo "参数错误!";
exit;
}

if ($_GET['action']==right){  //生成右侧排行
$time= mktime();
$time1=$time-(int)(3600*$sys_right_hour);

$sql1="select `cid`,`bk`,`title`,`click` FROM `{$fkduo}zhuti` where (`firsttime` between '$time1' and '$time') and img='0' and through='0' order by `click` desc limit $sys_right_list1";
$query1=mysql_query($sql1);//24小时人气排行

$sql3="select `cid`,`bk`,`title` FROM `{$fkduo}zhuti` where tj='1' and img='0' and through='0' order by `cid` DESC limit $sys_right_list3";
$query3=mysql_query($sql3);//版主推荐无图  

$sql2="select `cid`,`bk`,`title`,`img` FROM `{$fkduo}zhuti` where tj='1' and img!='0' and through='0' order by `cid` desc limit $sys_right_list2";
$query2=mysql_query($sql2);//推荐图片 

$html = $xingTemplate->fetch('rightmb');
$he="template/right.html";
$shuchu="右侧操作成功";  
  
  }



if ($_GET['action']==head){

function cls($cls){
global $zhuid;
if ($cls==$zhuid){
$cls="  class=\"yellow\">";
}else
{
$cls=">";
}
return $cls;
}

if ($_SESSION[power]!=1){
echo "<font color=red>管理重地，闲人勿进！</font>";
exit;
}
$sql="select * FROM `{$fkduo}bk` order by `px`";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
$nav=$nav."<a href=\"".url($row[bkid])."\"".cls($row[bkid]).$row[bkname]."</a>";

  }//生成导航  

$sql="select * FROM `{$fkduo}bkmaster` where `bkid`=$bk";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
  $bkmaster=$bkmaster."<a href=info.php?bk=".$row[uid]."  target=_blank>".$row[uid]."</a>&nbsp;";
  }//版主列表

$sql="select * FROM `{$fkduo}bk` where `bkid`=$bk limit 1";
$query=mysql_query($sql);
while ($row=mysql_fetch_array($query)){
  $bkname=$row[bkname];
  $bkjj=$row[bkjj];
  }//版块简介  


$html = $xingTemplate->fetch('headmb');
$he="template/head.html";
$shuchu="论坛导航生成成功";
  }
  
  
  
  
  
  if ($_GET['action']==link){

$sql="select * FROM `{$fkduo}link` order by `px`";
$query=mysql_query($sql);

while ($row=mysql_fetch_array($query)){
$str=$str."<a href='".$row[url]."' target=_blank>".$row[name]."</a>";
}


$html = $xingTemplate->fetch('linkmb');
$he="template/link.html";
$shuchu="友情链接生成成功";
}




if ($_GET['action']==listtop){
$sql1="select * FROM `{$fkduo}bkmaster` where `bkid`=$bk";
$query1=mysql_query($sql1);

$sql2="select * FROM `{$fkduo}bk` where `bkid`=$bk ";
$query2=mysql_query($sql2);
while ($row2=mysql_fetch_array($query2)){
$bkname=$row2[bkname];
$bkjj=$row2[bkjj];
  }//版块简介  
  
$sql3="select * FROM `{$fkduo}zhuti` where `bk`='$bk' and `zd`='1' and `hs`='0' order by `cid` desc limit 10";
$query3=mysql_query($sql3);

function uuuw($mkktime){ //时间转换格式
$mkktime=date("y-m-d H:i",$mkktime);
return $mkktime;  
}

function uuuy($mkktime){ //时间转换格式
$mkktime=date("m-d H:i",$mkktime);
return $mkktime;
}

 $html = $xingTemplate->fetch('listtopmb');
 $he="template/listtop".$bk.".html";
 $shuchu="操作成功";  
 }
  
    
  
  $handle=fopen($he,"w"); //
  fwrite($handle,$html); //
  fclose($handle);
  echo $shuchu;   
  
?>