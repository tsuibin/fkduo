<? 
include 'conn.php';
include 'check.php' ;

if ($_SESSION[lock]==1){
$tis= "�Բ�������˺Ŵ��ڶ����ڣ��޷�������";
tis($tis);
exit;
}

$filename="template/listtop{$_GET['bk']}.html";
if (!file_exists($filename)) {
$tis= "���������󣬻������ģ���ļ������ڣ�";
tis($tis);
exit;
} 


$query=mysql_query("select * FROM `{$fkduo}sort` where `bk`='$bk' ");

$listtop="listtop".$bk;//�ļ���
$cid=1;//�ٵ�CID


include 'xingTemplate.php';
$xingTemplate->display('post');
?>