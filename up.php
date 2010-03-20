<?php

                                                /******************************************************************************
                                                使用说明:
                                                1. 将PHP.INI文件里面的"extension=php_gd2.dll"一行前面的;号去掉,因为我们要用到GD库;
                                                2. 将extension_dir =改为你的php_gd2.dll所在目录;php4.6.0以上版本使用默认路径
                                                ******************************************************************************/
        //上传文件类型列表
        $uptypes=array(
                                                     'image/jpg',
                                                     'image/jpeg',
                                                     'image/pjpeg',
                                                     'image/gif',
                                                     'image/bmp',
        );

        include_once 'config/img.php';
        /*处理中文乱码问题*/
        //$waterstring = iconv('UTF-8','GBK',$waterstring);
		//var_dump($waterstring);
		//die();
	$max_file_size=$max_file_size*1000;
		
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
            //是否存在文件
            {
                echo "图片不存在!";
                exit;
            }
			
            $file = $_FILES["upfile"];
            if($max_file_size < $file["size"])
            //检查文件大小
            {   $max_file_size = $max_file_size/1000;
                echo "图片太大，超过 ".$max_file_size." KB!";
                exit;
            }
            if(!in_array($file["type"],$uptypes))
            //检查文件类型
            {
                echo "图片类型不符!".$file["type"];
                exit;
            }
            if(!file_exists($path_im))
            //检查上传目录是否存在，不存在创建
            {
                mkdir($path_im);
            }

            if(!file_exists($path_sim))
            //检查缩略图目录是否存在，不存在创建
            {
                mkdir($path_sim);
            }
            $filename = $file["tmp_name"];
            $im_size = getimagesize($filename);

            $src_w = $im_size[0];
            $src_h = $im_size[1];
            $src_type = $im_size[2];

            $pinfo = pathinfo($file["name"]);
            $filetype = $pinfo['extension'];
            $all_path = $path_im.time().".".$filetype;  //路径+文件名,目前以上传时间命名
            if (file_exists($all_path))
            {
                echo "同名文件已经存在了";
                exit;
            }
            if(!move_uploaded_file ($filename,$all_path))
            {
                echo "移动文件出错";
                exit;
            }
            $pinfo = pathinfo($all_path);
            $fname = $pinfo[basename];
			$pic=$all_path;//上传图片的地址


            switch($src_type)//判断源图片文件类型
            {
                case 1://gif
                    $src_im = imagecreatefromgif($all_path);//从源图片文件取得图像
                    break;
                case 2://jpg
                    $src_im = imagecreatefromjpeg($all_path);
                    break;
                case 3://png
                    $src_im = imagecreatefrompng($all_path);
                    break;
                default:
                    die("不支持的文件类型");
                    exit;
                }
				



                if($watermark == 1)
                {
                    //$iinfo = getimagesize($all_path,$iinfo);
                    $dst_im = imagecreatetruecolor($src_w,$src_h);
                    //根据原图尺寸创建一个相同大小的真彩色位图
                    $white = imagecolorallocate($dst_im,255,255,255);//白
                    //给新图填充背景色
                    $black = imagecolorallocate($dst_im,0,0,0);//黑
                    $red = imagecolorallocate($dst_im,255,0,0);//红
                    $orange = imagecolorallocate($dst_im,255,85,0);//橙
                    imagefill($dst_im,0,0,$white);
                    $angle =0;
                    $fontSize=12;
                    $fontFile='./include/simhei.ttf';
                    imagecopymerge($dst_im,$src_im,0,0,0,0,$src_w,$src_h,100);//原图图像写入新建真彩位图中
                    //imagefilledrectangle($dst_im,1,$src_h-15,80,$src_h,$white);
                    switch($watertype)
                    {
                        case 1:    //加水印字符串
                        	imagettftext($dst_im,$fontSize,$angle,$src_w-130,$src_h-35,$white,$fontFile,$waterstring);
                            //imagestring($dst_im,3,$src_w-130,$src_h-35,$waterstring,$white);//文字水印
                            break;
                        case 2:    //加水印图片

                            $lim_size = getimagesize($waterimg);        //取得水印图像尺寸，信息

                            switch($lim_size[2]) //判断水印图片文件类型
                            {
                                case 1://gif
                                    $src_lim = imagecreatefromgif($waterimg);  //取得水印图像
                                    break;
                                case 2://jpg
                                    $src_lim = imagecreatefromjpeg($waterimg);
                                    break;
                                case 3://png
                                    $src_lim = imagecreatefrompng($waterimg);
                                    break;
                                //case 6:
                                //$src_im=imagecreatefromwbmp($waterimg);
                                //break;
                                default:
                                    die("不支持的文件类型");
                                    exit;
                                }

                                $src_lw = ($src_w-$lim_size[0])/2;  //水印位于背景图正中央width定位
                                $src_lh = ($src_h-$lim_size[1])/2;  //height定位

                                imagecopymerge($dst_im,$src_lim,$src_lw,$src_lh,0,0,$lim_size[0],$lim_size [1],$waterclearly);//合并两个图像，设置水印透明度$waterclearly
                                imagedestroy($src_lim);
                                break;
                    }
                    switch($src_type)
                    {
                        case 1:
                            imagegif($dst_im,$all_path,$imclearly);//生成gif文件，图片清晰度0-100
                            break;
                        case 2:
                            imagejpeg($dst_im,$all_path,$imclearly);//生成jpg文件，图片清晰度0-100
                            break;
                        case 3:
                            imagepng($dst_im,$all_path,$imclearly);//生成png文件，图片清晰度0-100
                            break;
                        //case 6:
                        //imagewbmp($dst_im,$all_path);
                        break;
                    }
                    //释放缓存
                    imagedestroy($dst_im);
                }

                if($smallmark == 1)
                {
                    $sall_path = $path_sim.time().".".$filetype;

                    if (file_exists($sall_path))
                    {
                        echo "同名文件已经存在了";
                        exit;
                    }
					
					

                    if($src_w <= $dst_sw and $src_h <=130 ) // 原图宽尺寸 <= 缩略图尺寸
                    {   
					    //if ($dst_sh>100){$dst_sh=100;};
                        $dst_sim = imagecreatetruecolor($src_w,$src_h); //新建缩略图真彩位图
                        imagecopymerge($dst_sim,$src_im,0,0,0,0,$src_w,$src_h,100); //原图图像写入新建真彩位图中
                    }else

                    //if($src_w > $dst_sw) // 原图宽尺寸 > 缩略图尺寸
                    {
                        $dst_sh = $dst_sw/$src_w*$src_h; 
						if ($dst_sh>130){$dst_sh=130;$dst_sw=130*($src_w/$src_h);};
                        $dst_sim = imagecreatetruecolor($dst_sw,$dst_sh); //新建缩略图真彩位图（等比例缩小原图尺寸）
                        imagecopyresampled($dst_sim,$src_im,0,0,0,0,$dst_sw,$dst_sh,$src_w,$src_h); //原图图像写入新建真彩位图中
                    }

                    switch($src_type)
                    {
                        case 1:
                            imagegif($dst_sim,$sall_path,$simclearly);//生成gif文件，图片清晰度0-100
                            break;
                        case 2:
                            imagejpeg($dst_sim,$sall_path,$simclearly);//生成jpg文件，图片清晰度0-100
                            break;
                        case 3:
                            imagepng($dst_sim,$sall_path,$simclearly);//生成png文件，图片清晰度0-100
                            break;
                        case 6:
                            imagewbmp($dst_sim,$sall_path);
                            break;
                        }
                        //释放缓存
                        imagedestroy($dst_sim);
                    }

                    //释放缓存
                    imagedestroy($src_im);
                }				
			$img=$sall_path;//缩略图地址
			
$_SESSION[picallow]=$_SESSION[picallow]-1;		
$sql2="update `{$fkduo}user` set `picallow`=`picallow`-1 where (`logname`='$_SESSION[logname]') limit 1";
$query2=mysql_query($sql2);//更新用户发图数量

                ?>