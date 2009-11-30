<?


$replace="**";
$query=mysql_query("select * FROM `{$fkduo}replace` where `type`='1'");//替换词功能
while ($row=mysql_fetch_array($query)){
$content=str_replace($row[oldw],$replace,$content);
$title=str_replace($row[oldw],$replace,$title);
}

$through=0;
$query=mysql_query("select * FROM `{$fkduo}replace` where `type`='2'");//后台审核功能
while ($row=mysql_fetch_array($query)){

if (stristr($title,$row[oldw])){
$through=1;break;
}

if (stristr($content,$row[oldw])){
$through=1;break;
}

}

	


$query=mysql_query("select * FROM `{$fkduo}replace` where `type`='3'");//替换词功能
while ($row=mysql_fetch_array($query)){
$content=str_replace($row[oldw],$row[neww],$content);
$title=str_replace($row[oldw],$row[neww],$title);
}
?>