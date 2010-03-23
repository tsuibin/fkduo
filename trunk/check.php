<?
include_once 'tis.php';
if (!$_SESSION['logname']){
	$tis= 'your are not loggin，can\'t do this';
	tis($tis);
	exit;
}
?>