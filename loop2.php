<?
include 'conn.php';
include 'include/huhu.php';//
include 'tis.php';

$Description=1;//headmb

if ($jilu==0){
$tis= "�Բ��𣬵�ǰ���ⲻ���ڻ��ѱ�ɾ��";
tis($tis);
exit();
}




if ($huifu>0) {
$sql="select * from `{$fkduo}card` where (`cid`='$cid' and `hs`='0') order by lasttime limit $start,$contentstep";
$query=mysql_query($sql);
}

function uuuw($mkktime){
$mkktime=date("y-m-d H:i:s",$mkktime);
return $mkktime;
}

function uuue($mkktime){
$mkktime=date("Y-m-d",$mkktime);
return $mkktime;
}

function replyview($cid,$logname){
global $fkduo;
$sql3="select * from `{$fkduo}card` where (`cid`='$cid' and `hs`='0' and `lastlogname`='$logname')";
$query3=mysql_query($sql3);
$jilu=mysql_num_rows($query3);
if ($jilu>0){
return 1;
}else
{
return 0;
}
}

function msubstr($str, $start, $len) { //��ȡ����
    $tmpstr = ""; 
    $strlen = $start + $len; 
    for($i = 0; $i < $strlen; $i++) { 
        if(ord(substr($str, $i, 1)) > 0xa0) { 
            $tmpstr .= substr($str, $i, 2); 
            $i++; 
        } else 
            $tmpstr .= substr($str, $i, 1); 
    } 
    return $tmpstr; 
}

$z_content=$row2[content];//ֻ��ȡһ��
$Description1=msubstr($z_content,0,160);
$Description1=htmlentities($Description1, ENT_QUOTES,utf8);

$endtime=microtime(true);//�������ʱ��
$total=$endtime-$starttime; 
$runtimes="<center>{$total} second(s)</center>";

$listtop="listtop".$bk;//�ļ���
include 'xingTemplate.php';
$xingTemplate->setConfig('PHP_off',true);
$xingTemplate->display('icbc21');

$sql90="update `{$fkduo}zhuti` set `click`=`click`+1 where (`cid`='$cid')";
$query90=mysql_unbuffered_query($sql90); //

?>