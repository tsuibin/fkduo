<?
$yanc=1;
include 'conn.php';
include 'check.php' ;

if (empty($_POST['message']) or empty($_GET['cid'])) {
$tis= "���������������ҳ����в���"; 
tis($tis);
exit;
}

$_POST['title']=trim($_POST['title']);

if (empty($_POST['title'])){
$tis="�Բ��𣬱��ⲻ��Ϊ�գ�";
tis($tis);
exit;
}


$query11=mysql_query("select * from `{$fkduo}user` where `logname`='$_SESSION[logname]' limit 1");
$row11=mysql_fetch_array($query11) ;

if ($row11[lock]==1){
$tis="�Բ�������˺Ŵ��ڶ����ڣ��޷�������";
tis($tis);
exit;
}




$title=$_POST['title'];
$title=htmlentities($title, ENT_QUOTES,gb2312);
$title=str_replace("\r\n","",$title);
$title=addslashes($title);

$content=$_POST['message'];
$content=htmlentities($content, ENT_QUOTES,gb2312);
$content=str_replace("\r\n","<br />",$content); 
$content=addslashes($content);


include 'include/replace.php';//������˹��˴��ﴦ��


if (!($_POST['closecode']==1)){
include 'include/ubb.php';
}



$edittime=mktime();
$lc=(int)($_GET['lc']);



if ($_GET['action']==lz){

$sql="update `{$fkduo}zhuti` set `title`='$title',`content`='$content',`edit`='$edittime',`through`='$through',`edits`=`edits`+1 where (`cid`='$cid')";

$query=mysql_query($sql);//



$eee="postalert.php?action=lz&cid=".$cid."&bk=".$bk;

header ("location: $eee"); 

$tis="����ɹ�";

tis($tis);

}





elseif($_GET['action']==huifu)

{

$sql="update `{$fkduo}card` set `content`='$content',`edit`='$edittime',`through`='$through',`edits`=`edits`+1 where (`cid`='$cid' and `lc`='$lc')";

$query=mysql_query($sql);//



$eee="postalert.php?action=huifu&cid=".$cid."&bk=".$_GET['bk']."&now=".$_GET['now']."&pid=".$lc;

header ("location: $eee"); 

$tis="�ظ��ɹ�";

tis($tis);

}



?>