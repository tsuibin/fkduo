<?
include 'conn.php';
include 'check.php';

if ($_GET['action']==send){//SMS发送处理
	$to=ruku($_POST['to']);
	$from=$_SESSION[logname];

	$title=$_POST['title'];
	$title=htmlentities($title, ENT_QUOTES,utf8);
	$title=str_replace("\r\n","",$title);
	$title=addslashes($title);

	$content=$_POST['content'];
	$content=htmlentities($content, ENT_QUOTES,utf8);
	$content=str_replace("\r\n","<br />",$content);
	$content=addslashes($content);

	if (empty($title) or empty($to)) {
		$tis= "标题或用户名为空，发送失败"; 
		tis($tis);
		exit;
	}

	$sql6="select * FROM `{$fkduo}user` where (`logname`='$to') limit 1";
	$query6=mysql_query($sql6);
	$jilu=mysql_num_rows($query6);
	if ($jilu==0){
		$tis="找不到这个用户名，发送失败!";
		tis($tis);
		exit;
	}

	$sql="select * FROM `{$fkduo}user` where (`logname`='$from') limit 1";
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
	$fromnkname=$row[nickname];

	$time=mktime();
	$sql="INSERT INTO `{$fkduo}sms` (`title`,`content`,`from`,`fromnkname`,`to`,`time`,`read`) VALUES ('$title','$content','$from','$fromnkname','$to','$time','0')";
	$query=mysql_query($sql);//更新日志

	header ("location: my.php?action=mysms&mod=sendok");
	exit;}




	if ($_GET['action']==del){//SMS删除处理

		switch ($_GET['mod']){
			case listt:
				$idd=$_POST['Idx'];
				for ($i=0;$i<count($idd);$i++){
					$id=(int)($idd[$i]);
					mysql_query("DELETE FROM `{$fkduo}sms` WHERE `id`='$id' and `to`='$_SESSION[logname]'");
				}
				break;

			case one:
				$idd=(int)($_GET['id']);
				mysql_query("DELETE FROM `{$fkduo}sms` WHERE `id`='$idd' and `to`='$_SESSION[logname]'");
				break;

			default;
			echo "出错了！";
			exit;
		}
		header ("location: my.php?action=mysms&mod=delok");
		exit;
	}




	if ($_GET['action']==myinfook){//个人信息修改处理
		if (empty($_POST['oldpassword'])){
			$tis= "你没有输入原密码";
			tis($tis);
			exit;
		}

		if (!preg_match( "/^[^_][".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]{1,20}$/s ",$_POST['nickname'])) {
			$tis= "出错了，昵称不能含有特殊符号<br />(只允许汉字，英文字母，数字和下划线，中间不能有空格，长度10个字符内)"; 
			tis($tis);
			exit;
		}

		$_POST['email']=trim($_POST['email']);
		if(!ereg('^[a-zA-Z0-9\._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]+$',$_POST['email']))
		{
			$tis= "Email格式不正确，或者含有非法字符，请认真填写"; 
			tis($tis);
			exit;
		}


		$sql="select * from `{$fkduo}user` where (logname='$_SESSION[logname]')";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);

		$nickname=ruku($_POST['nickname']);
		$area=ruku($_POST['area']);
		$email=ruku($_POST['email']);

		$password=$row[pass];
		$oldpassword = md5(md5($_POST['oldpassword']).$row[salt]);

		if ($oldpassword!=$password){
			$tis= "密码不对，搞什么飞机啊！";
			tis($tis);
			exit;
		}

		$sign=$_POST['sign'];
		$sign=htmlentities($sign, ENT_QUOTES,'UTF-8');
		$sign=str_replace("\r\n","<br />",$sign);
		$sign=addslashes($sign);

		if (!empty($_POST['newpassword'])){//新密码是否设了
			$password = md5(md5($_POST['newpassword']).$row['salt']);
		}

		$sql="update `{$fkduo}user` set
		`nickname`='{$nickname}',
		`pass`='{$password}',
		`email`='{$email}',
		`area`='{$area}',
		`sign`='{$sign}' 
		
		where `logname`='{$_SESSION['logname']}' limit 1";
		/*
		 * sql的最后一句'{$_SESSION['logname']}'这个地方
		 * 如果不使用花括号告诉解析器这是一个变量
		 * 就会引起解析错误
		 * */

		$query=mysql_query($sql);//如果失败返回false

		//如果修改失败返回错误信息
		if($query){
			header ("location: my.php?action=myinfo&mod=ok");
		}else{
			//这里最好是做一个宏定义
			var_dump($sql);
			var_dump($query);
		}
		exit;
	}







	if ($_GET['action']==myfaceok){//头像上传处理
		if (is_uploaded_file($_FILES['upfile']['tmp_name'])){
			$upfile=$_FILES["upfile"];
			$type = $upfile["type"];
			$size = $upfile["size"];
			$tmp_name = $upfile["tmp_name"];
			$error = $upfile["error"];
			$image_size = getimagesize($tmp_name);
			$face_size=$face_size*1000;


			if ($size>$face_size){
				$tis= "错误，上传的头像文件大小不能超过".($face_size/1000)."K";
				tis($tis);
				exit;
			}

			if ($image_size[0]>100 or $image_size[1]>100){
				$tis= "错误，图片尺寸请限制在100*100以内";
				tis($tis);
				exit;
			}


			switch ($type) {
				case 'image/pjpeg' : $ok=1;
				$name=$_SESSION[logname].".jpg";
				$face=jpg;
				break;
				case 'image/jpeg' : $ok=1;
				$name=$_SESSION[logname].".jpg";
				$face=jpg;
				break;
				case 'image/gif' : $ok=1;
				$name=$_SESSION[logname].".gif";
				$face=gif;
				break;
				default:
					echo "不允许的文件内型";
					exit;
			}

			$name="html/face/".$name;

			if($ok && $error=='0'){
				move_uploaded_file($tmp_name,$name);
				mysql_query("update `{$fkduo}user` set `face`='$face' where (`logname`='$_SESSION[logname]') limit 1");
				$tis= "头像上传成功！<br />如果左侧头像图片没更新，请刷新一下。"; 
				tis($tis);
			}
		}exit;}





		if ($_GET['action']==favdel){//收藏夹删除
			switch ($_GET['mod']){
				case listt:
					$idd=$_POST['Idx'];
					$how=count($idd);
					for ($i=0;$i<count($idd);$i++){
						$id=(int)($idd[$i]);
						mysql_query("DELETE FROM `{$fkduo}fav` WHERE `cid`='$id' and `favuser`='$_SESSION[logname]'");
					}

					mysql_query("update `{$fkduo}user` set `favcount`=`favcount`-'$how' where (`logname`='$_SESSION[logname]')");
					break;

				default;
				echo "出错了！";
				exit;
			}
			header ("location: my.php?action=myfav&mod=delok");
		}
		?>