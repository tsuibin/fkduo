<?
include '../conn.php';

if ($_SESSION[power]!=1){
echo "<font color=red>管理重地，闲人勿进！</font>";
exit;
}
?>