<? include 'check.php'; ?>
<?

switch ($_GET[action]){
case add:
$str= <<< EOT
<?
\$sitename="$_POST[sitename]";       //��վ����
\$siteurl="$_POST[siteurl]";      //��վ��ַ������Ҫ��"/"
\$beian='$_POST[beian]';   //��վ�ı�����
\$sys_sitenameadd='$_POST[sys_sitenameadd]'; //���⸽����
\$sys_Keywords='$_POST[sys_Keywords]'; //��վ�ؼ��֣�����������ο�
\$sys_Description='$_POST[sys_Description]'; //��վ��飬����������ο�

\$zhuid='$_POST[zhuid]';         //����ID,������̳��ҳ��ʾ�İ���
\$liststep='$_POST[liststep]';     //�����б�һҳ��ʾ����������
\$contentstep='$_POST[contentstep]';   //��������һҳ��ʾ����������

\$sys_right_hour='$_POST[sys_right_hour]'; //�Ҳ���������ʱ�䷶Χ��Ĭ��24Сʱ
\$sys_right_list1='$_POST[sys_right_list1]'; //�Ҳ�XСʱ����������ʾ����
\$sys_right_list2='$_POST[sys_right_list2]'; //�Ҳ�����Ƽ�ͼƬ��ʾ����
\$sys_right_list3='$_POST[sys_right_list3]'; //�Ҳ�����Ƽ�������ʾ����


\$ftime='$_POST[ftime]';         //�����������������ˮ
\$hplower='$_POST[hplower]';      //���HP������,�ﵽ���Դ�ͼ�ͽ���!
\$hpstep='$_POST[hpstep]';      //hp����
\$logcount='$_POST[logcount]';     //��½���󳬹�5���Զ��ܾ���½15����
\$holdtime='$_POST[holdtime]';      //�û��೤ʱ�䲻����Զ��˳�����λ����

\$max_file_size='$_POST[max_file_size]';    //�����ϴ���ͼƬ��С���ƣ���λΪk
\$face_size='$_POST[face_size]';        //ͷ���ļ��Ĵ�С����λΪk

\$regemail='$_POST[regemail]';   //�Ƿ���ע��Email��֤����,1������0������.
\$sys_emailcontrol='$_POST[sys_emailcontrol]'; //EMAIL����
\$emailre='$_POST[emailre]';      //�û�ע�������Ƿ������ظ�,1Ϊ������,0Ϊ����
\$sys_rewrite='$_POST[sys_rewrite]'; //�Ƿ���URL��̬����
\$sys_sign='$_POST[sys_sign]'; //�Ƿ���ʾǩ����
\$sys_highlight='$_POST[sys_highlight]'; //�����������ɫ

\$version='1.1';   //�����������
?>
EOT;

  $he="../config/fkduo.php";
  $handle=fopen($he,"w"); //д�뷽ʽ������·��
  fwrite($handle,$str); //�Ѹղ��滻������д�����ɵ�HTML�ļ�
  fclose($handle);
  header ("location: info.php?action=ok");
exit;

case ok:
echo "<script language=\"javascript\"> alert(\"�޸ĳɹ���\");</script>";
break;

default:
break;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ޱ����ĵ�</title>
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
    <td colspan="2" bgcolor="#FFFF00">��վ��������</td>
  </tr>
  <tr>
    <td>��վ���ƣ�</td>
    <td>

        <input name="sitename" type="text" id="sitename" tabindex="1" value="<? echo $sitename ?>" />    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">��ַ��(����Ҫ��&quot;/&quot;)</td>
    <td bgcolor="#CCCCCC"><input name="siteurl" type="text" id="siteurl" tabindex="1" value="<? echo $siteurl ?>" /></td>
  </tr>
  <tr>
    <td>�����ţ�</td>
    <td><input name="beian" type="text" id="beian" tabindex="1" value="<? echo $beian ?>" /></td>
  </tr>
  
  
    <tr>
    <td>��վ���⸽���֣�</td>
    <td><input name="sys_sitenameadd" type="text" id="sys_sitenameadd" tabindex="1" value="<? echo $sys_sitenameadd ?>" size="35" /></td>
  </tr>
    <tr>
    <td>Meta Keywords��</td>
    <td><input name="sys_Keywords" type="text" id="sys_Keywords" tabindex="1" value="<? echo $sys_Keywords ?>" size="35" /></td>
  </tr>
    <tr>
    <td>Meta Description��</td>
    <td><input name="sys_Description" type="text" id="sys_Description" tabindex="1" value="<? echo $sys_Description ?>" size="35" /></td>
  </tr>
  
  
  
  <tr>
    <td bgcolor="#CCCCCC">����ID:(��̳��ҳ��ʾ�İ���)</td>
    <td bgcolor="#CCCCCC"><input name="zhuid" type="text" id="zhuid" tabindex="1" value="<? echo $zhuid ?>" size="5" />
      Ĭ��bk=1</td>
  </tr>
  <tr>
    <td>�����б�һҳ��ʾ��������</td>
    <td><input name="liststep" type="text" id="liststep" tabindex="1" value="<? echo $liststep ?>" size="5" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">��������һҳ��ʾ���ٻ���</td>
    <td bgcolor="#CCCCCC"><input name="contentstep" type="text" id="contentstep" tabindex="1" value="<? echo $contentstep ?>" size="5" /></td>
  </tr>
  
  
    <tr>
    <td bgcolor="#CCCCCC">�Ҳ���������ʱ�䷶Χ��Ĭ��24Сʱ</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_hour" type="text" id="sys_right_hour" tabindex="1" value="<? echo $sys_right_hour ?>" size="5" />
    Сʱ</td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">�Ҳ�XСʱ����������ʾ����</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list1" type="text" id="sys_right_list1" tabindex="1" value="<? echo $sys_right_list1 ?>" size="5" /></td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">�Ҳ�����Ƽ�ͼƬ��ʾ����</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list2" type="text" id="sys_right_list2" tabindex="1" value="<? echo $sys_right_list2 ?>" size="5" /></td>
  </tr>
    <tr>
    <td bgcolor="#CCCCCC">�Ҳ�����Ƽ�������ʾ����</td>
    <td bgcolor="#CCCCCC"><input name="sys_right_list3" type="text" id="sys_right_list3" tabindex="1" value="<? echo $sys_right_list3 ?>" size="5" /></td>
  </tr>
  
  
    <tr>
    <td bgcolor="#CCCCCC">�����������ɫ</td>
    <td bgcolor="#CCCCCC"><input name="sys_highlight" type="text" id="sys_highlight" tabindex="1" value="<? echo $sys_highlight ?>" size="8" />
    &nbsp;����red �� #FF0000</td>
  </tr>
  
  <tr>
    <td>�����������������ˮ</td>
    <td><input name="ftime" type="text" id="ftime" tabindex="1" value="<? echo $ftime ?>" size="5" />
      ��</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">���HP������,�ﵽ�˿��Դ�ͼ�ͽ���</td>
    <td bgcolor="#CCCCCC"><input name="hplower" type="text" id="hplower" tabindex="1" value="<? echo $hplower ?>" size="5" /></td>
  </tr>
  <tr>
    <td>hp����</td>
    <td><input name="hpstep" type="text" id="hpstep" tabindex="1" value="<? echo $hpstep ?>" size="5" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">��½���󳬹����ٴ��Զ��ܾ���½15����</td>
    <td bgcolor="#CCCCCC"><input name="logcount" type="text" id="logcount" tabindex="1" value="<? echo $logcount ?>" size="5" /> 
      �� </td>
  </tr>
  <tr>
    <td>�û��೤ʱ�䲻����Զ��˳�</td>
    <td><input name="holdtime" type="text" id="holdtime" tabindex="1" value="<? echo $holdtime ?>" size="5" />
      ����</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">�����ϴ���ͼƬ��С����</td>
    <td bgcolor="#CCCCCC"><input name="max_file_size" type="text" id="max_file_size" tabindex="1" value="<? echo $max_file_size ?>" size="5" /> 
      K </td>
  </tr>
  <tr>
    <td>ͷ���ļ��Ĵ�С</td>
    <td><input name="face_size" type="text" id="face_size" tabindex="1" value="<? echo $face_size ?>" size="5" /> 
      K </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">�û�ע���Ƿ�ҪEmail��֤(�������)<a href="email.php">����</a></td>
    <td bgcolor="#CCCCCC"><input name="regemail" type="radio" value="1" <? if ($regemail==1){ echo "checked=\"checked\"";} ?> />
��֤
  <input type="radio" name="regemail" value="0" <? if ($regemail==0){ echo "checked=\"checked\"";} ?> />
����֤</td>
  </tr>
  
    <tr>
    <td>�������ƣ�(����Email��֤��Ч���Զ��Ÿ���)</td>
    <td><input name="sys_emailcontrol" type="text" id="sys_emailcontrol" tabindex="1" value="<? echo $sys_emailcontrol ?>" size="40" /></td>
  </tr>
  
  <tr>
    <td>�û�ע�������Ƿ������ظ�</td>
    <td><label>
      <input name="emailre" type="radio" value="0" <? if ($emailre==0){ echo "checked=\"checked\"";} ?> />
      ����
      <input type="radio" name="emailre" value="1" <? if ($emailre==1){ echo "checked=\"checked\"";} ?> />
������</label></td>
  </tr>
  
  

  
    <tr>
    <td>�Ƿ���urlα��̬����</td>
    <td><label>
      <input name="sys_rewrite" type="radio" value="1" <? if ($sys_rewrite==1){ echo "checked=\"checked\"";} ?> />
      ����
      <input type="radio" name="sys_rewrite" value="0" <? if ($sys_rewrite==0){ echo "checked=\"checked\"";} ?> />
�ر�</label></td>
  </tr>
  
      <tr>
    <td>�����Ƿ���ʾǩ����</td>
    <td><label>
      <input name="sys_sign" type="radio" value="1" <? if ($sys_sign==1){ echo "checked=\"checked\"";} ?> />
      ��ʾ
      <input type="radio" name="sys_sign" value="0" <? if ($sys_sign==0){ echo "checked=\"checked\"";} ?> />
�ر�</label></td>
  </tr>
  
  
  <tr>
    <td colspan="2"><label>
     <center> <input type="submit" name="Submit" value="�� �� �� ��" />
    </center></label></td>
    </tr>
</table>
    </form>
</body>
</html>
