<? include 'check.php'; ?>
<?

switch ($_GET[action]){
case add:
$str= <<< EOT
<?
\$sitename="$_POST[sitename]";       //网站名称
\$siteurl="$_POST[siteurl]";      //网站网址，后面要有"/"
\$beian='$_POST[beian]';   //网站的备案号
\$sys_sitenameadd='$_POST[sys_sitenameadd]'; //标题附加字
\$sys_Keywords='$_POST[sys_Keywords]'; //网站关键字，供搜索引擎参考
\$sys_Description='$_POST[sys_Description]'; //网站简介，供搜索引擎参考

\$zhuid='$_POST[zhuid]';         //主版ID,即打开论坛首页显示的版面
\$liststep='$_POST[liststep]';     //贴子列表一页显示多少条标题
\$contentstep='$_POST[contentstep]';   //贴子内容一页显示多少条回帖

\$sys_right_hour='$_POST[sys_right_hour]'; //右侧人气排行时间范围，默认24小时
\$sys_right_list1='$_POST[sys_right_list1]'; //右侧X小时人气排行显示条数
\$sys_right_list2='$_POST[sys_right_list2]'; //右侧版主推荐图片显示条数
\$sys_right_list3='$_POST[sys_right_list3]'; //右侧版主推荐文章显示条数


\$ftime='$_POST[ftime]';         //发贴间隔秒数，防灌水
\$hplower='$_POST[hplower]';      //最低HP升级数,达到可以传图和奖分!
\$hpstep='$_POST[hpstep]';      //hp步数
\$logcount='$_POST[logcount]';     //登陆错误超过5次自动拒绝登陆15分钟
\$holdtime='$_POST[holdtime]';      //用户多长时间不活动就自动退出，单位分钟

\$max_file_size='$_POST[max_file_size]';    //附件上传的图片大小限制，单位为k
\$face_size='$_POST[face_size]';        //头像文件的大小，单位为k

\$regemail='$_POST[regemail]';   //是否开启注册Email验证功能,1开启，0不开启.
\$sys_emailcontrol='$_POST[sys_emailcontrol]'; //EMAIL限制
\$emailre='$_POST[emailre]';      //用户注册邮箱是否允许重复,1为不允许,0为允许。
\$sys_rewrite='$_POST[sys_rewrite]'; //是否开启URL静态功能
\$sys_sign='$_POST[sys_sign]'; //是否显示签名档
\$sys_highlight='$_POST[sys_highlight]'; //主题高亮的颜色

\$version='1.1';   //此项请勿更改
?>
EOT;

  $he="../config/fkduo.php";
  $handle=fopen($he,"w"); //写入方式打开新闻路径
  fwrite($handle,$str); //把刚才替换的内容写进生成的HTML文件
  fclose($handle);
  header ("location: info.php?action=ok");
exit;

case ok:
echo "<script language=\"javascript\"> alert(\"修改成功！\");</script>";
break;

default:
break;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<style type="text/css">
<!--
.aaaa {
	font-size: 12px;
}
-->
</style>
</head>

<body>
<?
if(file_exists("../config/fkduo.php")){
include '../config/fkduo.php';
} 
?>

<form action="info.php?action=add" method="post" name="form1" class="aaaa" id="form1">
<table width="515" height="495" border="1">
  <tr>
    <td colspan="2" bgcolor="#FFFF00">网站基本配置</td>
  </tr>
  <tr>
    <td>网站名称：</td>
    <td>

        <input name="sitename" type="text" id="sitename" tabindex="1" value="<? echo $sitename ?>" />    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">网址：(后面要加&quot;/&quot;)</td>
    <td bgcolor="#CCCCCC"><input name="siteurl" type="text" id="siteurl" tabindex="1" value="<? echo $siteurl ?>" /></td>
  </tr>
  <tr>
    <td>备案号：</td>
    <td><input name="beian" type="text" id="beian" tabindex="1" value="<? echo $beian ?>" /></td>
  </tr>
  
  
    <tr>
    <td>网站标题附加字：</td>
    <td><input name="sys_sitenameadd" type="text" id="sys_sitenameadd" tabindex="1" value="<? echo $sys_sitenameadd ?>" size="35" /></td>
  </tr>
    <tr>
    <td>Meta Keywords：</td>
    <td><input name="sys_Keywords" type="text" id="sys_Keywords" tabindex="1" value="<? echo $sys_Keywords ?>" size="35" /></td>
  </tr>
    <tr>
    <td>Meta Description：</td>
    <td><input name="sys_Description" type="text" id="sys_Description" tabindex="1" value="<? echo $sys_Description ?>" size="35" /></td>
  </tr>
  
  
  
  <tr>
    <td bgcolor="#CCCCCC">主版ID:(论坛首页显示的版面)</td>
    <td bgcolor="#CCCCCC"><input name="zhuid" type="text" id="zhuid" tabindex="1" value="<? echo $zhuid ?>" size="5" />
      默认bk=1</td>
  </tr>
  <tr>
    <td>贴子列表一页显示多少主题</td>
    <td><input name="liststep" type="text" id="liststep" tabindex="1" value="<? echo $liststep ?>" size="5" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">贴子内容一页显示多少回帖</td>
    <td bgcolor="#CCCCCC"><input name="contentstep" type="text" id="contentstep" tabindex="1" value="<? echo $contentstep ?>" size="5" /></td>
  </tr>
  
  
    <tr>
    <td bgcolor="#CCCCCC">右侧人气排行时间范围，默认24小时</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_hour" type="text" id="sys_right_hour" tabindex="1" value="<? echo $sys_right_hour ?>" size="5" />
    小时</td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">右侧X小时人气排行显示条数</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list1" type="text" id="sys_right_list1" tabindex="1" value="<? echo $sys_right_list1 ?>" size="5" /></td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">右侧版主推荐图片显示条数</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list2" type="text" id="sys_right_list2" tabindex="1" value="<? echo $sys_right_list2 ?>" size="5" /></td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">右侧版主推荐文章显示条数</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list3" type="text" id="sys_right_list3" tabindex="1" value="<? echo $sys_right_list3 ?>" size="5" /></td>
  </tr>
  
  
    <tr>
    <td bgcolor="#CCCCCC">主题高亮的颜色</td>
    <td bgcolor="#CCCCCC"><input name="sys_highlight" type="text" id="sys_highlight" tabindex="1" value="<? echo $sys_highlight ?>" size="8" />
    &nbsp;例：red 或 #FF0000</td>
  </tr>
  
  <tr>
    <td>发贴间隔秒数，防灌水</td>
    <td><input name="ftime" type="text" id="ftime" tabindex="1" value="<? echo $ftime ?>" size="5" />
      秒</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">最低HP升级数,达到此可以传图和奖分</td>
    <td bgcolor="#CCCCCC"><input name="hplower" type="text" id="hplower" tabindex="1" value="<? echo $hplower ?>" size="5" /></td>
  </tr>
  <tr>
    <td>hp步数</td>
    <td><input name="hpstep" type="text" id="hpstep" tabindex="1" value="<? echo $hpstep ?>" size="5" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">登陆错误超过多少次自动拒绝登陆15分钟</td>
    <td bgcolor="#CCCCCC"><input name="logcount" type="text" id="logcount" tabindex="1" value="<? echo $logcount ?>" size="5" /> 
      次 </td>
  </tr>
  <tr>
    <td>用户多长时间不活动就自动退出</td>
    <td><input name="holdtime" type="text" id="holdtime" tabindex="1" value="<? echo $holdtime ?>" size="5" />
      分钟</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">附件上传的图片大小限制</td>
    <td bgcolor="#CCCCCC"><input name="max_file_size" type="text" id="max_file_size" tabindex="1" value="<? echo $max_file_size ?>" size="5" /> 
      K </td>
  </tr>
  <tr>
    <td>头像文件的大小</td>
    <td><input name="face_size" type="text" id="face_size" tabindex="1" value="<? echo $face_size ?>" size="5" /> 
      K </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">用户注册是否要Email验证(防广告贴)<a href="email.php">配置</a></td>
    <td bgcolor="#CCCCCC"><input name="regemail" type="radio" value="1" <? if ($regemail==1){ echo "checked=\"checked\"";} ?> />
验证
  <input type="radio" name="regemail" value="0" <? if ($regemail==0){ echo "checked=\"checked\"";} ?> />
不验证</td>
  </tr>
  
    <tr>
    <td>邮箱限制：(开启Email验证生效，以逗号隔开)</td>
    <td><input name="sys_emailcontrol" type="text" id="sys_emailcontrol" tabindex="1" value="<? echo $sys_emailcontrol ?>" size="40" /></td>
  </tr>
  
  <tr>
    <td>用户注册邮箱是否允许重复</td>
    <td><label>
      <input name="emailre" type="radio" value="0" <? if ($emailre==0){ echo "checked=\"checked\"";} ?> />
      允许
      <input type="radio" name="emailre" value="1" <? if ($emailre==1){ echo "checked=\"checked\"";} ?> />
不允许</label></td>
  </tr>
  
  

  
    <tr>
    <td>是否开启url伪静态功能</td>
    <td><label>
      <input name="sys_rewrite" type="radio" value="1" <? if ($sys_rewrite==1){ echo "checked=\"checked\"";} ?> />
      开启
      <input type="radio" name="sys_rewrite" value="0" <? if ($sys_rewrite==0){ echo "checked=\"checked\"";} ?> />
关闭</label></td>
  </tr>
  
      <tr>
    <td>帖子是否显示签名档</td>
    <td><label>
      <input name="sys_sign" type="radio" value="1" <? if ($sys_sign==1){ echo "checked=\"checked\"";} ?> />
      显示
      <input type="radio" name="sys_sign" value="0" <? if ($sys_sign==0){ echo "checked=\"checked\"";} ?> />
关闭</label></td>
  </tr>
  
  
  <tr>
    <td colspan="2"><label>
     <center> <input type="submit" name="Submit" value="提 交 修 改" />
    </center></label></td>
    </tr>
</table>
    </form>
</body>
</html>
