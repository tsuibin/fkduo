<?


//��ҳ����loop2.php��ҳҳ��--��ҳ���ƻ���վ������
$now=(int)($_GET['now']);
if ($now==0) {
$now=1;
}


$sql2="select * from `{$fkduo}zhuti` where `cid`='$cid'";
$query2=mysql_query($sql2);
//$jilu=mysql_num_rows($query2);
$row2=mysql_fetch_array($query2);
$huifu=$row2[huifu];
$title=$row2[title];



if ($huifu<$contentstep){ //��ҳ��
$pnum=1;
}elseif($huifu%$contentstep==0)
{
$pnum=(int)($huifu/$contentstep);
}elseif($huifu%$contentstep>0)
{
$pnum=(int)($huifu/$contentstep)+1;
}








//3�����
//now=1
//now=2
//now>2

//��now==1��""; 
function now1($now,$pnum,$contentstep,$cid,$bk) {
//$start=($now-1)*$contentstep;//Ĭ��

if ($pnum<=1){
//echo "��";
//$start=0;
}elseif ($pnum>1 and $pnum<=9)
{
$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str2=$str2."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str=$str1.$str2;
//return $str;
}elseif ($pnum>9)
{
$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=9;$i++) 
{
$str2=$str2."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str3="&nbsp;".$pnum.">>";
$str=$str1.$str2.$str3;
//return $str;
}
return $str;
}



function now2($now,$pnum,$contentstep,$cid,$bk) { //��now=2;
//$start=($now-1)*$contentstep;//Ĭ��
if ($pnum<=1){
//echo "��";
//$start=0;
}elseif ($pnum>1 and $pnum<=9)
{
$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-1).">".($now-1)."</a>&nbsp;";

$str2="<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str3=$str3."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str=$str1.$str2.$str3;
//return $str;


}elseif ($pnum>9)
{

$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-1).">".($now-1)."</a>&nbsp;";
$str2="<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=9;$i++) 
{
$str3=$str3."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str4="&nbsp;".$pnum.">>";
$str=$str1.$str2.$str3.$str4;

}
return $str;
}


function now3($now,$pnum,$contentstep,$cid,$bk) { //��now>2;
//$start=($now-1)*$contentstep;//Ĭ��
if (($now+8)<$pnum) {
$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-2).">".($now-2)."</a>&nbsp;";
$str2="<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-1).">".($now-1)."</a>&nbsp;";
$str3."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=($now+6);$i++) 
{
$str4=$str4."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str5="&nbsp;".$pnum.">>";
$str=$str1.$str2.$str3.$str4.$str5;
}elseif (($now+8)>=$pnum) {

$str1="<<"."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-2).">".($now-2)."</a>&nbsp;";
$str2="<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".($now-1).">".($now-1)."</a>&nbsp;";
$str3="<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$now.">[".$now."]</a>&nbsp;";
for ($i=$now+1;$i<=$pnum;$i++) 
{
$str4=$str4."<a href=loop2.php?bk=".$bk."&cid=".$cid."&now=".$i.">".$i."</a>&nbsp;";
}
$str5="&nbsp;".$pnum.">>";
$str=$str1.$str2.$str3.$str4.$str5;
}
return $str;
}




switch ($now){

case 1:
$scfy=now1($now,$pnum,$contentstep,$cid,$bk);break;//�����ҳ
case 2:
$scfy=now2($now,$pnum,$contentstep,$cid,$bk);break;
default:
$scfy=now3($now,$pnum,$contentstep,$cid,$bk);break;
}

//$aaaa=now1($now,$pnum,$contentstep,$cid,$bk);
//echo $aaaa;

$start=($now-1)*$contentstep;


?>