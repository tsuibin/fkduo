<?
session_start();
$_SESSION[abcd]=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>��װ��</title>
<style type="text/css">
* { margin: 0; padding: 0; }
label { width: 200px; float: left; }
p { margin-bottom: 14px; }
h1 { font-size: 20px; background: #888; color: #fff; height: 37px; line-height: 37px; margin-bottom: 10px; }
h2 { font-size: 100%; margin-bottom: 10px; }
#wrapper { width: 500px; height: 250px; padding: 15px 10px; border: 1px solid #ccc; overflow: auto; }
#progress_w { width: 500px; height: 18px; border: 1px solid #333; margin-bottom: 10px; }
#progress { height: 18px; }
</style>
</head>

<body>
<h1>��װ��</h1>
<?php
if (!$_POST['step']){

  function iswrite($files){
    
	if(!is_writable($files)){
	echo "&nbsp;&nbsp;".$files.":&nbsp;&nbsp;";
  	echo "<font color=red>����,����д</font><br />";
	$_SESSION[abcd]=1;
    }else{
	echo "&nbsp;&nbsp;".$files.":&nbsp;&nbsp;";
  	echo "<font color=green>��д</font><br />";
    }

  }
  
 echo "��ⰲװĿ¼��Ȩ��<br />";
 echo "(�����ʹ�õ���Linux �� Freebsd����������ȷ������Ŀ¼���ļ�������Ϊ (777) ��дģʽ��
)<br /><br />";
  
	iswrite('../template/');  
	iswrite('../config/'); 
	iswrite('../html/face/'); 
	iswrite('../html/up/img/');   
	iswrite('../html/up/pic/');
	iswrite('../html/Compile/');
	iswrite('../install/');
	iswrite('..install/install.php');
	iswrite('..config/database.php');

  
  echo $passd;
  echo "<br /><br />";
  
if ($_SESSION[abcd]==1){
echo "<font color=red><b>&nbsp;�ļ�Ȩ�޼�ⲻͨ��,�޷���װ!</b></font><br />";
echo "(�뽫����д��Ŀ¼��Ϊ777,Ȼ��ˢ�±�ҳ��)";
exit;
}else{
echo "<font color=blue>���ͨ��������Խ�����һ��</font>";
}

  
?>
<form action="install.php" method="post">
<p><input type="hidden" name="step" value="1" /></p>
<p><input type="submit" value="��һ��" name="ok" /></p>
</form>

<?php
/*��װ�ĵ�һ��*/
}elseif($_POST['step']=='1')
 {
?>
<h2>��ʼ��װ</h2>
<form action="install.php" method="post">
		<p><label>��������ַ��</label><input type="text" name="host" value="localhost" />* һ��Ϊlocalhost</p>
		<p><label>�������û�����</label><input name="name_s" type="text" value="root" />
		*</p>
		<p><label>�������û����룺</label><input type="text" name="pass" /> ���û�����þͲ�����</p>
		<p><label>���ݿ����ƣ�</label><input type="text" name="database" />*</p>
		<p><label>���ݱ�ǰ׺��</label><input name="table_prefix" type="text" /> 
		��������Ϊfkduo_</p>
		<p><input type="hidden" name="step" value="2" /></p>
		<p><input type="submit" value="��һ��" name="ok" /></p>
</form>
<?php
/*��װ�ĵڶ���*/
}elseif($_POST['step']=='2'){
	$host = trim($_POST['host']);
	$name = trim($_POST['name_s']);
	$pass = trim($_POST['pass']);
	$database = trim($_POST['database']);

	$table_prefix = trim($_POST['table_prefix']) ? trim($_POST['table_prefix']) : 'fkduo_';
	
	if($host==''||$name==''||$database==''){
		echo '<p>��ȷ�ϱ���д�Ƿ���д</p>','<p><input type="button" value="��һ��" onclick="history.back()" /></p>';
		exit();
	}
	
	$conn = @mysql_connect($host,$name,$pass) or die('
		<p>��ȷ�Ϸ�������ַ���������û������������û������Ƿ���ȷ��</p>
		<p><input type="button" value="��һ��" onclick="history.back()" /></p>
	');

	mysql_query("CREATE DATABASE IF NOT EXISTS `".$database."` DEFAULT CHARACTER SET utf8") or die(mysql_error());
	mysql_select_db($database,$conn) or die("û�и����ݿ�");
	mysql_query("set names 'utf8'");
	mysql_query("SET character_set_client = utf8;");
    mysql_query("SET character_set_connection = utf8;");
    mysql_query("SET character_set_database = utf8;");
    mysql_query("SET character_set_results = utf8;");
    mysql_query("SET character_set_server = utf8;");

    mysql_query("SET collation_connection = utf8;");
    mysql_query("SET collation_database = utf8;");
    mysql_query("SET collation_server = utf8;");


	
	$file = 'fkduo.sql';
	echo '<h2 id="prompt">���ڰ�װ�����Ե�...</h2>',
		 '<div id="progress_w"><div id="progress"></div></div>',
		 '<div id="wrapper"><div id="info">';
	if(file_exists($file)){
		$handle = fopen($file,'r');
		$buffer = fread($handle,filesize($file));
		fclose($handle);
		$buffer = str_replace('{table_prefix}',$table_prefix,$buffer);
		$arr = explode(";\r",$buffer);
		//��ջ��ɾ�����һ����SQL��������
		array_pop($arr);
		//����һ���ж����ű�
		$total_table = preg_match_all("/CREATE TABLE `(.*)` /i",$buffer,$a);
		//������
		$n = 0;
		//���������SQL��䲢ִ��
		foreach($arr as $query){
			//��װ�������Ŀ��
			$width = 500;
                        mysql_query("set names 'utf8'");
			mysql_query($query) or die(mysql_error());
			//ƥ�佨�����SQL���
			$is = preg_match("/CREATE TABLE `(.*)` /i",$query,$arr_preg);
			if($is){
				$n++;
				$progress = ceil(($n/$total_table)*$width);
				echo '���ڴ����� ',$arr_preg[1],'... <font color=red>�ɹ�</font><br />',
					 '<script type="text/javascript">',
					 	'var wrapper = document.getElementById("wrapper");',
					 	'var height = wrapper.clientHeight;',
						'wrapper.scrollTop = document.getElementById("info").offsetHeight + 30 - height;',
						'var progress = document.getElementById("progress");',
						'progress.style.background = "#999";',
						'progress.style.width = "',$progress,'px"',
					 '</script>';
				//ѭ��һ����ʾһ��
				flush();
			}
		}
		echo '</div></div>';
	}else{
		echo 'SQL�ĵ����ļ������ڣ���װ�޷�������',dirname(__FILE__),'/fkduo.sql';
		exit();
	}
	
	$file = '../config/database.php';	
	if(file_exists($file)){
		$handle = fopen($file,'r');
		$buffer = fread($handle,filesize($file));
		fclose($handle);
		$mode = array('#host#','#name#','#pass#','#database#','#$table_prefix#');
		$subject = array($host,$name,$pass,$database,$table_prefix);
		$buffer = str_replace($mode,$subject,$buffer);
		$handle = fopen($file,'w');
		fwrite($handle,$buffer);
		fclose($handle);
	}
	
	echo '<script type="text/javascript">document.getElementById("prompt").innerHTML = "��װ��������ܿ�ɣ�^_^";</script>';
	
	$filename="install.lock";
    if (file_exists($filename)) {
	unlink($filename);
    } 
	rename("install.php","install.lock");
}
?>
</body>
</html>
