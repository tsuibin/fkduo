<? 
include 'conn.php';
$bk=no;
$bkk=alert;


switch ($_GET['action']){
	case lz:
	$ghgh=url2($_GET['bk'],$_GET['cid']); 
	break;
	
	case huifu:
	$ghgh=url2($_GET['bk'],$_GET['cid'],$_GET['now'])."#pid".$_GET['pid']; 
	break;
	
	default:
	exit;
}
include 'xingTemplate.php';
$xingTemplate->display('alert');

?>