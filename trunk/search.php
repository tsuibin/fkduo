<?
include 'conn.php';

$filename="template/listtop{$_GET['bk']}.html";
if (!file_exists($filename)) {
include 'tis.php';
$tis= "版块参数错误，或者相关模板文件不存在！";
tis($tis);
exit;
} 

$keyword1=urldecode(iconv("UTF-8", "gb2312", "$_GET['keyword']"));
$keyword1=addslashes($keyword1);//
$kk1=urlencode(iconv("gb2312", "UTF-8", "$keyword1"));   //翻页url

$action=(int)($_GET['action']);
$bkk=bk;
$navtis="(<font color=green><b>当前搜索结果</b></font>)";
$listtop="listtop".$bk;//文件名


    switch ($action){
        case 1:   
		$keyword="%".$keyword1."%"; //乱码
            $search="and `title` like '$keyword'";
            break;
        case 2:
		$keyword=$keyword1;
            $search="and `firstnkname`='$keyword'";
            break;
			
		case 3:
		$keyword=$keyword1;
            $search="and `firstlogname`='$keyword'";
            break;
			
        default:
            //
            break;
    }
	

$sql="select `cid` FROM `{$fkduo}zhuti` where (`bk`='$bk' and `zd`='0' and `hs`='0' and through='0' $search )";
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

//$pages=1;

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
$thedown="<a href=search.php?bk=".$bk."&action=".$action."&keyword=".$kk1."&now=".($now+1).">下一页</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=search.php?bk=".$bk."&action=".$action."&keyword=".$kk1."&now=".($now-1).">上一页</a>";
$thedown="<a href=search.php?bk=".$bk."&action=".$action."&keyword=".$kk1."&now=".($now+1).">下一页</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=search.php?bk=".$bk."&action=".$action."&keyword=".$kk1."&now=".($pages-1).">上一页</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}


function uuuw($mkktime){ //时间转换格式
$mkktime=date("09-m-d H:i",$mkktime);
return $mkktime;  
}

function uuuy($mkktime){ //时间转换格式
$mkktime=date("m-d H:i",$mkktime);
return $mkktime;
}


$sql="select * FROM `{$fkduo}zhuti` where (`bk`='$bk' and `zd`='0' and `hs`='0' and through='0' $search ) order by lasttime DESC limit $start,$liststep";
$query=mysql_query($sql);

include 'xingTemplate.php';
$xingTemplate->display('search');
?>