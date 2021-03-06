<?php
session_start();
$_SESSION['abcd']=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<title>安装向导</title>
<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

label {
	width: 200px;
	float: left;
}

p {
	margin-bottom: 14px;
}

h1 {
	font-size: 20px;
	background: #888;
	color: #fff;
	height: 37px;
	line-height: 37px;
	margin-bottom: 10px;
}

h2 {
	font-size: 100%;
	margin-bottom: 10px;
}

#wrapper {
	width: 500px;
	height: 250px;
	padding: 15px 10px;
	border: 1px solid #ccc;
	overflow: auto;
}

#progress_w {
	width: 500px;
	height: 18px;
	border: 1px solid #333;
	margin-bottom: 10px;
}

#progress {
	height: 18px;
}
</style>
</head>

<body>
<h1>安装向导</h1>
<?php
if (!$_POST['step']){

	function iswrite($files){

		if(!is_writable($files)){
			echo "&nbsp;&nbsp;".$files.":&nbsp;&nbsp;";
			echo "<font color=red>错误,不可写</font><br />";
			$_SESSION['abcd']=1;
		}else{
			echo "&nbsp;&nbsp;".$files.":&nbsp;&nbsp;";
			echo "<font color=green>可写</font><br />";
		}

	}

	echo "检测安装目录的权限<br />";
	echo "如果您使用的是Linux 或 Freebsd服务器，先确认以下目录或文件的属性为 (777) 可写模式。
)<br /><br />";

	iswrite('../template/');
	iswrite('../config/');
	iswrite('../html/face/');
	iswrite('../html/up/img/');
	iswrite('../html/up/pic/');
	iswrite('../html/Compile/');
	iswrite('../install/');
	iswrite('../install/install.php');
	iswrite('../config/database.php');


	echo $passd;
	echo "<br /><br />";

	if ($_SESSION['abcd']==1){
		echo "<font color=red><b>&nbsp;文件权限检测不通过,无法安装!</b></font><br />";
		echo "(请将不可写的目录设为777,然后刷新本页面)";
		exit;
	}else{
		echo "<font color=blue>检测通过，你可以进入下一步</font>";
	}
	?>
<pre>
	<form action="install.php" method="post">
		<input type="hidden" name="step" value="1" />
		<input type="submit" value="下一步" name="ok" />
	</form>
</pre>


	<?php
	/*安装的第一步*/
}elseif($_POST['step']=='1')
{
	?>
<h2>开始安装</h2>
<form action="install.php" method="post">
<p><label>服务器地址：</label><input type="text" name="host" value="localhost" />*
一般为localhost</p>
<p><label>服务器用户名：</label><input name="name_s" type="text" value="root" />
*</p>
<p><label>服务器用户密码：</label><input type="text" name="pass" /> 如果没有设置就不用填</p>
<p><label>数据库名称：</label><input type="text" name="database" />*</p>
<p><label>数据表前缀：</label><input name="table_prefix" type="text" />
如果不填就为fkduo_</p>
<p><input type="hidden" name="step" value="2" /></p>
<p><input type="submit" value="下一步" name="ok" /></p>
</form>
	<?php
	/*安装的第二步*/
}elseif($_POST['step']=='2'){
	$host = trim($_POST['host']);
	$name = trim($_POST['name_s']);
	$pass = trim($_POST['pass']);
	$database = trim($_POST['database']);

	$table_prefix = trim($_POST['table_prefix']) ? trim($_POST['table_prefix']) : 'fkduo_';

	if($host==''||$name==''||$database==''){
		echo '<p>请确认必填写是否填写</p>','<p><input type="button" value="上一步" onclick="history.back()" /></p>';
		exit();
	}

	$conn = @mysql_connect($host,$name,$pass) or die('
		<p>请确认服务器地址、服务器用户名、服务器用户密码是否正确！</p>
		<p><input type="button" value="上一步" onclick="history.back()" /></p>
	');

	mysql_query("CREATE DATABASE IF NOT EXISTS `".$database."` DEFAULT CHARACTER SET utf8") or die(mysql_error());
	mysql_select_db($database,$conn) or die("没有该数据库");
	mysql_query("set names 'utf8'");
	mysql_query("SET character_set_client = utf8;");
	mysql_query("SET character_set_connection = utf8;");
	mysql_query("SET character_set_database = utf8;");
	mysql_query("SET character_set_results = utf8;");
	mysql_query("SET character_set_server = utf8;");

	mysql_query("SET collation_connection = utf8;");
	mysql_query("SET collation_database = utf8;");
	mysql_query("SET collation_server = utf8;");



	$file = 'mysql.sql';
	echo '<h2 id="prompt">正在安装，请稍等...</h2>',
		 '<div id="progress_w"><div id="progress"></div></div>',
		 '<div id="wrapper"><div id="info">';
	if(file_exists($file)){
		$handle = fopen($file,'r');
		$buffer = fread($handle,filesize($file));
		fclose($handle);
		$buffer = str_replace('{table_prefix}',$table_prefix,$buffer);
		$arr = explode(";\r",$buffer);
		//出栈，删除最后一个空SQL语句的数组
		array_pop($arr);
		//计算一共有多少张表
		$total_table = preg_match_all("/CREATE TABLE `(.*)` /i",$buffer,$a);
		//计数器
		$n = 0;
		//遍历开割开的SQL语句并执行
		foreach($arr as $query){
			//安装进度条的宽度
			$width = 500;
			mysql_query("set names 'utf8'");
			mysql_query($query) or die(mysql_error());
			//匹配建立表的SQL语句
			$is = preg_match("/CREATE TABLE `(.*)` /i",$query,$arr_preg);
			if($is){
				$n++;
				$progress = ceil(($n/$total_table)*$width);
				echo '正在创建表 ',$arr_preg[1],'... <font color=red>成功</font><br />',
					 '<script type="text/javascript">',
					 	'var wrapper = document.getElementById("wrapper");',
					 	'var height = wrapper.clientHeight;',
						'wrapper.scrollTop = document.getElementById("info").offsetHeight + 30 - height;',
						'var progress = document.getElementById("progress");',
						'progress.style.background = "#999";',
						'progress.style.width = "',$progress,'px"',
					 '</script>';
				//循环一次显示一次
				flush();
			}
		}
		echo '</div></div>';
	}else{
		echo 'SQL的导入文件不存在，安装无法继续！',dirname(__FILE__),'/mysql.sql';
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

	echo '<script type="text/javascript">document.getElementById("prompt").innerHTML = "安装完成啦，很快吧！^_^";</script>';

	$filename="install.lock";
	if (file_exists($filename)) {
		unlink($filename);
	}
	rename("install.php","install.lock");
}
?>
</body>
</html>
