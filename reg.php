<?
include 'conn.php';
//include 'tis.php';
include 'xingTemplate.php';

if ($regemail==1 and $_GET['action']==sendok){
$xingTemplate->display('regemail');
exit;
}

if ($regemail==0){
$xingTemplate->display('reg');
exit;
}else
{
if (empty($_GET['id'])){
//$tis="δ֪��������Ҫͨ���ʼ���֤����ܷ��ʱ�ҳ�棡";
$xingTemplate->display('regemail');
exit;
}else{
$_SESSION[id]=$id=(int)($_GET['id']);
$code=ruku($_GET['code']);
$query=mysql_query("select * FROM `{$fkduo}emailact` where `id`='$id' and `code`='$code' and `doo`='0'");
$row=mysql_fetch_array($query);
$jilu=mysql_num_rows($query);

if ($jilu=='0'){
$tis="�Բ���������֤�벻��ȷ���ѹ��ڣ�";
$xingTemplate->display('tis');
exit;
}
$_SESSION[email]=$email=$row[email];
$_SESSION[regallow]=1;
$xingTemplate->display('reg');
}
}

?>