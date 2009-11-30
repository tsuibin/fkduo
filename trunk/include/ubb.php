<?php
function get_ubb($str) {

    	$str = preg_replace("/(\{)(\d{1,2})(\})/i", "<img src=\"html/ico/ico\\2.gif\" />", $str);
		$str=preg_replace("/\[url\](.+?)\[\/url\]/eis","httpurl('\\1')",$str);		
		$str=preg_replace("/\[url=(.+?)\](.+?)\[\/url\]/eis","httpurl2('\\1','\\2')",$str);        
        $str = preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$str); 
		$str=preg_replace("/\[img\](.+?)\[\/img\]/eis","imgurl('\\1')",$str); 
        $str = preg_replace("(\[br\])", "<br>", $str);
   	    $str = preg_replace("/\[quote\](.+?)\[\/quote\]/is", "<center><table border=\"0\" width=\"90%\" cellspacing=\"1\" cellpadding=\"5\" bgcolor=\"#CCCCCC\"><tr><td bgcolor=\"#F0F0F0\">\\1</td></tr></table></center>", $str);	   
		$str = preg_replace("/\[flash\](.+?)\[\/flash\]/eis", "flashurl('\\1')", $str);
    	return $str;
}
$content=get_ubb($content);


//function checkurl($urlgg){//�����ַ�Ƿ����
//$urlgg3=$urlgg; //ԭʼ
//$urlgg=str_replace("&", "fkduo-sadfvbn", $urlgg);//'&'�޷�ֱ�Ӵ���
//$str1=array('"', '<', '>','(',')','*',' ','	','fkduo-sadfvbn#',';');//��վ���˴ʴ���..
//$str1[]="'"; //׷�ӵ�����
//$urlgg=trim($urlgg);
//$urlgg1=str_replace($str1, "", $urlgg);
//if ($urlgg1!=$urlgg){ //��������ַ
//return 1;
//}else
//{
//return 0;
//}
//}



function checkurl($urlgg){//�����ַ�Ƿ����
//$urlgg3=$urlgg; //ԭʼ
//$urlgg=str_replace("&", "fkduo-sadfvbn", $urlgg);//'&'�޷�ֱ�Ӵ���
//$str1=array('"', '<', '>','(',')','*',' ','	','&#',"'");//��վ���˴ʴ���..

$str1=array('&quot;', '&lt;', '&gt;','(',')','*',' ','	','&amp;#','&#039;');//��վ���˴ʴ���..
$urlgg=trim($urlgg);
$urlgg1=str_replace($str1, "fkduo", $urlgg);
if ($urlgg1!=$urlgg){ //��������ַ
return 1;
}else
{
return 0;
}
}



function imgurl($urlgg){
if (is_array($urlgg)) {
foreach ($urlgg as $key => $value) {
$urlgg[$key] = imgurl($value);
}
} else
{

global $siteurl;
if (!stripos($urlgg,"://")>0){ //��http
$urlgg="{$siteurl}$urlgg";
}
if (checkurl($urlgg)==1){ //��������ַ
$urlgg="[img]".$urlgg."[/img]"; 
}else
{
$urlgg="<a href=\"".$urlgg."\" target=_blank><img src=\"".$urlgg."\" alt=\"����鿴ȫͼ\" onload=\"if(this.width>600) {this.width=600;}\" /></a>";
}


return $urlgg;
}
}



function flashurl($urlgg){
if (is_array($urlgg)) {
foreach ($urlgg as $key => $value) {
$urlgg[$key] = flashurl($value);
}
} else
{
global $siteurl;
if (!stripos($urlgg,"://")>0){ //��http
$urlgg="{$siteurl}$urlgg";
}
if (checkurl($urlgg)==1){ //��������ַ
$urlgg="[flash]".$urlgg."[/flash]"; 
}else
{
$urlgg="<embed src=\"".$urlgg."\" quality=\"high\" width=\"480\" height=\"400\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\"></embed>";
}
return $urlgg;
}
}



function httpurl($urlgg){
if (is_array($urlgg)) {
foreach ($urlgg as $key => $value) {
$urlgg[$key] = httpurl($value);
}
} else
{
global $siteurl;
if (!stripos($urlgg,"://")>0){ //��http
$urlgg="{$siteurl}$urlgg";
}
if (checkurl($urlgg)==1){ //��������ַ
$urlgg="[url]".$urlgg."[/url]"; 
}else
{
$urlgg="<a href=\"".$urlgg."\" target=\"_blank\">".$urlgg."</a>";
}
return $urlgg;
}
}


function httpurl2($urlgg,$sitenames=url){
if (is_array($urlgg)) {
foreach ($urlgg as $key => $value) {
$urlgg[$key] = httpurl2($value);
}
} else
{
global $siteurl;
if (!stripos($urlgg,"://")>0){ //��http
$urlgg="{$siteurl}$urlgg";
}
if (checkurl($urlgg)==1){ //��������ַ
$urlgg="[url=".$urlgg."]".$sitenames."[/url]"; 
}else
{
$urlgg="<a href=\"".$urlgg."\" target=\"_blank\">".$sitenames."</a>";
}
return $urlgg;
}
}

?>