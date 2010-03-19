<?
//本页生成loop2.php分页页数
$now=(int)($_GET['now']);
if ($now==0) {
$now=1;
}


$sql2="select * from {$fkduo}zhuti where `cid`='$cid' and `hs`='0'";
$query2=mysql_query($sql2);
$jilu=mysql_num_rows($query2);
$row2=mysql_fetch_array($query2);
$huifu=$row2[huifu];
$title=$row2[title];



if ($huifu<$contentstep){ //求页数
$pnum=1;
}elseif($huifu%$contentstep==0)
{
$pnum=(int)($huifu/$contentstep);
}elseif($huifu%$contentstep>0)
{
$pnum=(int)($huifu/$contentstep)+1;
}


class a1{
function url2($bk,$cid,$now=1){
global $sys_rewrite;
if ($sys_rewrite==1){
$url="loop2,{$bk},{$cid},{$now}.html";
}else
{
$url="loop2.php?bk={$bk}&cid={$cid}&now={$now}";
}
return $url;
}
}


//当now==1或""; 
function now1($now,$pnum,$contentstep,$cid,$bk) {
//$start=($now-1)*$contentstep;//默认
$pa1=new a1();
$firstxu="<a href=".$pa1->url2($bk,$cid)."><<</a>&nbsp;";
$lastxu="&nbsp;<a href=".$pa1->url2($bk,$cid,$pnum).">>></a>";

if ($pnum<=1){
//echo "空";
//$start=0;
}elseif ($pnum>1 and $pnum<=9)
{
$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str2=$str2."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str=$str1.$str2;
//return $str;
}elseif ($pnum>9)
{
$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=9;$i++) 
{
$str2=$str2."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str3="&nbsp;".$pnum.$lastxu;
$str=$str1.$str2.$str3;
//return $str;
}
return $str;
$pa1=null;
}



function now2($now,$pnum,$contentstep,$cid,$bk) { //当now=2;
$pa1=new a1();
$firstxu="<a href=".$pa1->url2($bk,$cid)."><<</a>&nbsp;";
$lastxu="&nbsp;<a href=".$pa1->url2($bk,$cid,$pnum).">>></a>";


if ($pnum<=1){
//echo "空";
//$start=0;
}elseif ($pnum>1 and $pnum<=9)
{
$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now-1).">".($now-1)."</a>&nbsp;";

$str2="<a href=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str3=$str3."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str=$str1.$str2.$str3;
//return $str;


}elseif ($pnum>9)
{

$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now-1).">".($now-1)."</a>&nbsp;";
$str2="<a href=loop2.php?bk=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=9;$i++) 
{
$str3=$str3."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str4="&nbsp;".$pnum.$lastxu;
$str=$str1.$str2.$str3.$str4;

}
return $str;
$pa1=null;
}


function now3($now,$pnum,$contentstep,$cid,$bk) { //当now>2;

$pa1=new a1();
$firstxu="<a href=".$pa1->url2($bk,$cid)."><<</a>&nbsp;";
$lastxu="&nbsp;<a href=".$pa1->url2($bk,$cid,$pnum).">>></a>";

if (($now+8)<$pnum) {
$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now-2).">".($now-2)."</a>&nbsp;";
$str2="<a href=".$pa1->url2($bk,$cid,$now-1).">".($now-1)."</a>&nbsp;";
$str3="<a href=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=($now+6);$i++) 
{
$str4=$str4."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str5="&nbsp;".$pnum.$lastxu;
$str=$str1.$str2.$str3.$str4.$str5;
}elseif (($now+8)>=$pnum) {

$str1=$firstxu."<a href=".$pa1->url2($bk,$cid,$now-2).">".($now-2)."</a>&nbsp;";
$str2="<a href=".$pa1->url2($bk,$cid,$now-1).">".($now-1)."</a>&nbsp;";
$str3="<a href=".$pa1->url2($bk,$cid,$now).">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str4=$str4."<a href=".$pa1->url2($bk,$cid,$i).">".$i."</a>&nbsp;";
}
$str5="&nbsp;".$pnum.$lastxu;
$str=$str1.$str2.$str3.$str4.$str5;
}
return $str;
$pa1=null;
}




switch ($now){

case 1:
$scfy=now1($now,$pnum,$contentstep,$cid,$bk);break;//输出分页
case 2:
$scfy=now2($now,$pnum,$contentstep,$cid,$bk);break;
default:
$scfy=now3($now,$pnum,$contentstep,$cid,$bk);break;
}

$start=($now-1)*$contentstep;
?>