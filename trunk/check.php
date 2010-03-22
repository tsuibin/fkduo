<?
include_once 'tis.php';
if (!$_SESSION['logname']){
	$tis= '您没有登录，还不能进行此操作';
	tis($tis);
	exit;
}
?>