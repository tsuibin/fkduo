<?
include 'conn.php';
include 'check.php' ;
$bk='no';

function uuuw($mkktime){ //时间转换格式
	$mkktime=date("y-m-d H:i",$mkktime);
	return $mkktime;
}

include 'xingTemplate.php';//打头

if(!isset($_GET['action'])){
	$_GET['action']=myinfo;
}

$sql2="select * FROM `{$fkduo}user` where `logname`='$_SESSION[logname]' limit 1";
$query2=mysql_query($sql2);
$row2=mysql_fetch_array($query2) ;

if ($_GET['action']==myinfo){ //个人信息
	$row2[sign] = preg_replace("/\<([\/]?)br(.*?)\>/i","\n",$row2[sign]); // /b的
	$xingTemplate->display('my');

	if ($_GET['mod']==ok){
		echo "<script language=\"javascript\"> alert(\"修改成功！\");</script>";
	}
	exit;
}


if ($_GET['action']==myfav){ //我的收藏
	$sql="select * FROM `{$fkduo}fav` where `favuser`='$_SESSION[logname]'";
	$query=mysql_query($sql);
	$rows=mysql_num_rows($query);

	if ($rows<$liststep) {
		$pages=1;
	}elseif($rows%$liststep==0)
	{
		$pages=(int)($rows/$liststep);
	}elseif($rows%$liststep>0)
	{
		$pages=(int)($rows/$liststep)+1;
	}

	if ((int)($_GET['now'])==0){
		$now=1;
	}else{
		$now=(int)($_GET['now']);
	}

	if ($now==1 and $pages==1)
	{
		$start=0;
	}elseif ($now==1 and $pages>1)
	{
		$thedown="<a href=my.php?action=myfav&now=".($now+1).">下一页</a>";
		$start=0;
	}elseif ($now>1 and $now<$pages)
	{
		$theup="<a href=my.php?action=myfav&now=".($now-1).">上一页</a>";
		$thedown="<a href=my.php?action=myfav&now=".($now+1).">下一页</a>";
		$start=($now-1)*$liststep;
	}elseif (($now>1 and $now==$pages) or ($now>$pages))
	{
		$theup="<a href=my.php?action=myfav&now=".($now-1).">上一页</a>";
		$start=($pages-1)*$liststep;
		$now=$pages;
	}


	$sql="select * FROM `{$fkduo}fav` where (`favuser`='$_SESSION[logname]') order by favtime DESC limit $start,$liststep";
	$query=mysql_query($sql);
	$xingTemplate->display('my');

	if ($_GET['mod']==delok){
		echo "<Script language='JavaScript'> alert('删除成功！');</Script>";
	}
	exit;
}



if ($_GET['action']==mypost){ //我的贴子
	$sql="select * FROM `{$fkduo}zhuti` where `firstlogname`='$_SESSION[logname]' and `hs`='0'";
	$query=mysql_query($sql);
	$rows=mysql_num_rows($query);


	if ($rows<$liststep) {
		$pages=1;
	}elseif($rows%$liststep==0)
	{
		$pages=(int)($rows/$liststep);
	}elseif($rows%$liststep>0)
	{
		$pages=(int)($rows/$liststep)+1;
	}

	if ((int)($_GET['now'])==0){
		$now=1;
	}else{
		$now=(int)($_GET['now']);
	}

	if ($now==1 and $pages==1)
	{
		$start=0;
	}elseif ($now==1 and $pages>1)
	{
		$thedown="<a href=my.php?action=mypost&now=".($now+1).">下一页</a>";
		$start=0;
	}elseif ($now>1 and $now<$pages)
	{
		$theup="<a href=my.php?action=mypost&now=".($now-1).">上一页</a>";
		$thedown="<a href=my.php?action=mypost&now=".($now+1).">下一页</a>";
		$start=($now-1)*$liststep;
	}elseif (($now>1 and $now==$pages) or ($now>$pages))
	{
		$theup="<a href=my.php?action=mypost&now=".($now-1).">上一页</a>";
		$start=($pages-1)*$liststep;
		$now=$pages;
	}

	$sql="select * from `{$fkduo}zhuti` where (`firstlogname`='$_SESSION[logname]'  and `hs`='0') order by lasttime DESC limit $start,$liststep";
	$query=mysql_query($sql);
	$xingTemplate->display('my');
	exit;
}



if ($_GET['action']==mysms){ //我的短信

	$sql="select * FROM `{$fkduo}sms` where (`to`='$_SESSION[logname]') order by `time` DESC";
	$query=mysql_query($sql);
	$rows=mysql_num_rows($query);

	if ($rows<$liststep) {
		$pages=1;
	}elseif($rows%$liststep==0)
	{
		$pages=(int)($rows/$liststep);
	}elseif($rows%$liststep>0)
	{
		$pages=(int)($rows/$liststep)+1;
	}

	if ((int)($_GET['now'])==0){
		$now=1;
	}else{
		$now=(int)($_GET['now']);
	}

	if ($now==1 and $pages==1)
	{
		$start=0;
	}elseif ($now==1 and $pages>1)
	{
		$thedown="<a href=my.php?action=mysms&now=".($now+1).">下一页</a>";
		$start=0;
	}elseif ($now>1 and $now<$pages)
	{
		$theup="<a href=my.php?action=mysms&now=".($now-1).">上一页</a>";
		$thedown="<a href=my.php?action=mysms&now=".($now+1).">下一页</a>";
		$start=($now-1)*$liststep;
	}elseif (($now>1 and $now==$pages) or ($now>$pages))
	{
		$theup="<a href=my.php?action=mysms&now=".($now-1).">上一页</a>";
		$start=($pages-1)*$liststep;
		$now=$pages;
	}

	$sql="select * FROM `{$fkduo}sms` where (`to`='$_SESSION[logname]') order by `time` DESC limit $start,$liststep";
	$query=mysql_query($sql);
	$xingTemplate->display('my');

	if ($_GET['mod']==sendok){
		echo "<Script language='JavaScript'> alert('短信发送成功！');</Script>";
	}
	if ($_GET['mod']==delok){
		echo "<Script language='JavaScript'> alert('短信删除成功！');</Script>";
	}
	exit;
}



if ($_GET['action']==myface){ //我的头像
	$xingTemplate->display('my');
	exit;
}




if ($_GET['action']==sendsms){ //发送短信

	if (isset($_GET['logname'])){
		$logname=ruku($_GET['logname']);
		$sql="select * FROM `{$fkduo}user` where `logname`='$logname' limit 1";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query) ;
		if (!($row[logname]==$logname))
		{
			$tis='收件人有误，没有这个用户名！';
			$xingTemplate->display('tis');
			exit;
		}}
		$xingTemplate->display('my');
		exit;
}




if ($_GET['action']==readsms){ //阅读短信
	$id=(int)($_GET['id']);
	$sql="select * FROM `{$fkduo}sms` where (`id`='$id') limit 1";
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
	$xingTemplate->display('my');
	if ($row[read]==0){
		$sql="update `{$fkduo}sms` set `read`=1 where (`id`='$id') limit 1";
		$query=mysql_query($sql);//短信改为已读
	}
	exit;
}



?>