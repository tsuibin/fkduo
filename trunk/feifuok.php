<?
$yanc=1;
include 'conn.php';
include 'check.php' ;

$_POST['message']=trim($_POST['message']);

if (empty($_POST['message']) or empty($_GET['cid'])) {
$tis= "参数错误，或回复内容不能为空，请从正常页面进行操作"; 
tis($tis);
exit;
}

$favtime=$lasttime=mktime();

$query9=mysql_query("select * FROM `{$fkduo}user` where `logname`='$_SESSION[logname]' limit 1");
$row9=mysql_fetch_array($query9) ;
if ($row9[lock]==1){
$tis="对不起，你的账号处于冻结期，无法发贴！";
tis($tis);
exit;
}

if (($lasttime-$row9[lastft])<$ftime){
$tis="对不起，你的发贴间隔时间少于".$ftime."秒！";
tis($tis);
exit;
}


$sql2="select * FROM `{$fkduo}zhuti` where (cid='$cid') limit 1";
$query2=mysql_query($sql2);
$row2=mysql_fetch_array($query2);
$lcnow=$row2[huifu]+1;//jump用
$lc=$row2[huifuall]+1;
$favtitle=$row2[title];//增加收藏用

if ($row2[lock]==1)
{
$tis= "本贴已锁定，暂时不可以回复！";
tis($tis);
exit;
}


if (is_uploaded_file($_FILES["upfile"][tmp_name]))//是否有上传文件要处理
{

if ($_SESSION[picallow]<1){

$tis="您今天的发图额度已用完！";
tis($tis);
exit;
}

$smallmark = 2;//不生成缩略图
include 'up.php';
}else
{
$img=0;
}

//$content=strip_tags($_POST['message'],"<b>");//

$content=$_POST['message'];
$content=htmlentities($content, ENT_QUOTES,gb2312);
$content=str_replace("\r\n","<br />",$content);  
$content=addslashes($content);
include 'include/ubb.php';
include 'include/replace.php';//进行审核过滤词语处理

$ip=$_SERVER['REMOTE_ADDR']; 

$lastlogname=$_SESSION[logname];


$regtime=$row9[regtime];
$hp=$row9[hp];
$pp=$row9[pp];
$favcount=$row9[favcount];//收藏数量
$lastnkname=$row9[nickname];
$sign=$row9[sign];
$zts=$row9[zts];
$hfs=$row9[hfs]+1;
$face=$row9[face];
$area=$row9[area];

$tis="出错了，回复不成功，请联系管理员。";
$sql="INSERT INTO `{$fkduo}card` (`content`,`bk`,`lastlogname`,`lastnkname`,`lasttime`,`pic`,`ip`,`cid`,`lc`,`regtime`,`hp`,`pp`,`area`,`sign`,`through`,`zts`,`hfs`,`face`) VALUES ('$content','$bk','$lastlogname','$lastnkname','$lasttime','$pic','$ip','$cid','$lc','$regtime','$hp','$pp','$area','$sign','$through','$zts','$hfs','$face')";
$query=mysql_query($sql) or die(tis($tis));//更新日志

$sql2="update `{$fkduo}user` set `hfs`=`hfs`+1,`lastft`='$lasttime' where (`logname`='$lastlogname') limit 1";
$query2=mysql_query($sql2);//更新用户发贴总数


$sql3="update `{$fkduo}zhuti` set `huifu`=`huifu`+1,`huifuall`=`huifuall`+1,`lasttime`='$lasttime',`lastnkname`='$lastnkname',`lastlogname`='$lastlogname' where (`cid`='$cid') limit 1";
$query3=mysql_query($sql3);//更新主题回复数信息



if ($_POST['checkbox']==checkbox){

$sql2="select * from `{$fkduo}fav` where (cid='$cid' and favuser='$lastlogname')";
$rowu=mysql_num_rows(mysql_query($sql2));
if ($rowu==0){

if ($favcount>10){
$tis= "帖子回复成功，但是您的收藏夹已满，请先删除无用收藏再进行操作！";
tis($tis);
exit(); }
else{
$sql="INSERT INTO `{$fkduo}fav` (`cid`,`title`,`bk`,`favuser`,`favtime`) VALUES ('$cid', '$favtitle', '$bk', '$lastlogname', '$lasttime')";
$query=mysql_query($sql);

$sql2="update `{$fkduo}user` set `favcount`=`favcount`+1 where (`logname`='$lastlogname') limit 1";
$query2=mysql_query($sql2);//更新用户收藏夹总数

$sql2="update `{$fkduo}zhuti` set `favcount`=`favcount`+1 where (`cid`='$cid') limit 1";
mysql_query($sql2); }
}
else
{
$tis= "帖子回复<font color=red>成功</font>，但收藏<font color=red>不成功</font>，因为您已经收藏过此贴！";
tis($tis);
exit();
}


}


if ($lcnow<$contentstep){ //求回复后要返回的页数
$now=1;
}
elseif($lcnow%$contentstep==0)
{
$now=(int)($lcnow/$contentstep);
}elseif($lcnow%$contentstep>0)
{
$now=(int)($lcnow/$contentstep)+1;
}



$eee="postalert.php?action=huifu&cid=".$cid."&bk=".$bk."&now=".$now."&pid=".$lc;
header ("location: $eee"); 
?>