<?
include 'conn.php';

if (!isset($_GET['action'])){
include 'xingTemplate.php';
$xingTemplate->display('log');
exit;
}


include 'tis.php';
if ($_GET['action']==out) {
session_destroy();
header ("location: log.php");
exit;
}


$yanc=1;
if (empty($_POST['logname'])){
$tis= "用户名不能为空！";
tis($tis);
exit;
}

$logname=trim($_POST['logname']);

$logname=addslashes($logname);
$now1=$aa2=mktime();
$aa1=$aa2-899;
$logip=$_SERVER["REMOTE_ADDR"];

$sql="select * FROM `{$fkduo}userlog` where (logip='$logip' and `errortime` between '$aa1' and '$aa2')";
$query=mysql_query($sql);
$jilu=mysql_num_rows($query);
if ($jilu>=$logcount){
$tis="<b>此次输入无效，您当前密码错误次数过多，请 15 分钟后再尝试！</b>";
tis($tis);
exit;
}




$sql="select * FROM `{$fkduo}user` where (logname='$logname')";
$query=mysql_query($sql);
$row=mysql_fetch_array($query);
$oldtime=$row[lasttime];
$power=$row[power];
$hp=$row[hp];
$pp=$row[pp];     //$salt=$row[salt];
$password=$_POST['pass'];
$ppallow=$row[ppallow];
$lock=$row[lock];
$locktime=$row[locktime];
$picallow=$row[picallow];
$password = md5(md5($password).$row[salt]);

if ($lock==1 and $locktime<=$now1){//解封
$lock=0;
}

if ($power!=0 and $power<4)
{
$power=3;
}




if ($row[pass]===$password) {
$_SESSION[logname]=$logname;
$_SESSION[power]=$power;
$_SESSION[hp]=$hp;
$_SESSION[pp]=$pp;
$_SESSION[ppallow]=$ppallow;
$_SESSION[picallow]=$picallow;
$_SESSION[holdtimes]=$now1;
$_SESSION[lock]=$lock;

$lasttime =$now1; //设新时间
$oldtime=(int)date('Ymd',$oldtime);
$newtime=date('Ymd',$lasttime);
if ($oldtime<$newtime){ //

$_SESSION[hp]=$hp=$hp+1;//
if ($hp==$hplower){
$ppallow=1;
}elseif($hp>$hplower){
$ppallow=(int)(($hp-$hplower)/$hpstep)+1;//重置
}


$_SESSION[picallow]=$_SESSION[ppallow]=$picallow=$ppallow;
$sql2="update `{$fkduo}user` set `hp`='$hp',`lasttime`='$lasttime',`lock`='$lock',`ppallow`='$ppallow',`picallow`='$picallow' where (`logname`='$logname') limit 1";
}else
{
$sql2="update `{$fkduo}user` set `lasttime`='$lasttime',`lock`='$lock' where (`logname`='$logname') limit 1";
}
$query2=mysql_query($sql2);//
if ($power==3){
$_SESSION[picallow]=$_SESSION[ppallow]=888;
}
header ("location: index.php"); //
}else
{
$sql="INSERT INTO `{$fkduo}userlog` (`logip`,`errortime`) VALUES ('$logip', '$aa2')";
$query=mysql_query($sql);
$tis= "账号或者密码不正确，请重新输入！<br>还可尝试:<font color=red>".($logcount-$jilu-1)."</font>次";
tis($tis);
}
?>