<?
include 'conn.php';
include 'tis.php';

if (empty($_GET['logname']))
{
$tis= "û������û���";
tis($tis);
exit;
}
$logname=ruku($_GET['logname']);

$sql="select * FROM `{$fkduo}user` where `logname`='$logname' limit 1";
$query=mysql_query($sql);
$row=mysql_fetch_array($query) ;

if (!($row[logname]==$logname))
{
$tis= "û������û���";
tis($tis);
exit;
}


function uuuw($mkktime){ //ʱ��ת����ʽ
$mkktime=date("y-m-d H:i",$mkktime);
return $mkktime;  
}


$sql="select * FROM `{$fkduo}zhuti` where (`firstlogname`='$logname' and `hs`='0') ORDER BY `firsttime` DESC";
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
$thedown="<a href=info.php?logname={$logname}&now=".($now+1).">��һҳ</a>";
$start=0;
}elseif ($now>1 and $now<$pages)
{
$theup="<a href=info.php?logname={$logname}&now=".($now-1).">��һҳ</a>";
$thedown="<a href=info.php?logname={$logname}&now=".($now+1).">��һҳ</a>";
$start=($now-1)*$liststep;
}elseif (($now>1 and $now==$pages) or ($now>$pages))
{
$theup="<a href=info.php?logname={$logname}&now=".($now-1).">��һҳ</a>";
$start=($pages-1)*$liststep;
$now=$pages;
}




$sql2="select * from `{$fkduo}zhuti` where (`firstlogname`='$logname'  and `hs`='0') order by lasttime DESC limit $start,$liststep";
$query2=mysql_query($sql2);
$jilu=mysql_num_rows($query2);



$sql3="select * FROM `{$fkduo}zhuti` where (`firstlogname`='$logname' and `hs`='0') ORDER BY `click` DESC limit 10";
$query3=mysql_query($sql3);

include 'xingTemplate.php';
$xingTemplate->display('info');

?>