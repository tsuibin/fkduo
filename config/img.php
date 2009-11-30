<?

$path_im = "html/up/pic/";      //生成大图保存文件夹路径
$path_sim = "html/up/img/";    //缩略图保存文件夹路径
$watermark = 1;              //是否加水印(1为加水印,0为不加水印);
$watertype = 1;              //水印类型(1为文字,2为图片)
$waterstring = "www.fkduo.cn";   //上传图片的水印字符串
$waterimg = "water.png";     //若为图片水印,水印图片文件路径
$waterclearly = 65;         //水印透明度0-100，数字小透明高
$imclearly = 80;            //图片清晰度0-100，数字越大越清晰，文件尺寸越大
$simclearly = 80;            //缩略图清晰度0-100，数字越大越清晰，文件尺寸越大
//$smallmark = 1;              //是否生成缩略图(1为加生成,其他为不);
$dst_sw = 130;                //定义缩略图宽度，高度我采用等比例缩放

?>