<?php

                                                /******************************************************************************
                                                ʹ��˵��:
                                                1. ��PHP.INI�ļ������"extension=php_gd2.dll"һ��ǰ���;��ȥ��,��Ϊ����Ҫ�õ�GD��;
                                                2. ��extension_dir =��Ϊ���php_gd2.dll����Ŀ¼;php4.6.0���ϰ汾ʹ��Ĭ��·��
                                                ******************************************************************************/
        //�ϴ��ļ������б�
        $uptypes=array(
                                                     'image/jpg',
                                                     'image/jpeg',
                                                     'image/pjpeg',
                                                     'image/gif',
                                                     'image/bmp',
        );

        include_once 'config/img.php';

	$max_file_size=$max_file_size*1000;
		
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if (!is_uploaded_file($_FILES["upfile"][tmp_name]))
            //�Ƿ�����ļ�
            {
                echo "ͼƬ������!";
                exit;
            }
			
            $file = $_FILES["upfile"];
            if($max_file_size < $file["size"])
            //����ļ���С
            {   $max_file_size = $max_file_size/1000;
                echo "ͼƬ̫�󣬳��� ".$max_file_size." KB!";
                exit;
            }
            if(!in_array($file["type"],$uptypes))
            //����ļ�����
            {
                echo "ͼƬ���Ͳ���!".$file["type"];
                exit;
            }
            if(!file_exists($path_im))
            //����ϴ�Ŀ¼�Ƿ���ڣ������ڴ���
            {
                mkdir($path_im);
            }

            if(!file_exists($path_sim))
            //�������ͼĿ¼�Ƿ���ڣ������ڴ���
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
            $all_path = $path_im.time().".".$filetype;  //·��+�ļ���,Ŀǰ���ϴ�ʱ������
            if (file_exists($all_path))
            {
                echo "ͬ���ļ��Ѿ�������";
                exit;
            }
            if(!move_uploaded_file ($filename,$all_path))
            {
                echo "�ƶ��ļ�����";
                exit;
            }
            $pinfo = pathinfo($all_path);
            $fname = $pinfo[basename];
			$pic=$all_path;//�ϴ�ͼƬ�ĵ�ַ


            switch($src_type)//�ж�ԴͼƬ�ļ�����
            {
                case 1://gif
                    $src_im = imagecreatefromgif($all_path);//��ԴͼƬ�ļ�ȡ��ͼ��
                    break;
                case 2://jpg
                    $src_im = imagecreatefromjpeg($all_path);
                    break;
                case 3://png
                    $src_im = imagecreatefrompng($all_path);
                    break;
                default:
                    die("��֧�ֵ��ļ�����");
                    exit;
                }
				



                if($watermark == 1)
                {
                    //$iinfo = getimagesize($all_path,$iinfo);
                    $dst_im = imagecreatetruecolor($src_w,$src_h);
                    //����ԭͼ�ߴ紴��һ����ͬ��С�����ɫλͼ
                    $white = imagecolorallocate($dst_im,255,255,255);//��
                    //����ͼ��䱳��ɫ
                    $black = imagecolorallocate($dst_im,0,0,0);//��
                    $red = imagecolorallocate($dst_im,255,0,0);//��
                    $orange = imagecolorallocate($dst_im,255,85,0);//��
                    imagefill($dst_im,0,0,$white);

                    imagecopymerge($dst_im,$src_im,0,0,0,0,$src_w,$src_h,100);//ԭͼͼ��д���½����λͼ��
                    //imagefilledrectangle($dst_im,1,$src_h-15,80,$src_h,$white);
                    switch($watertype)
                    {
                        case 1:    //��ˮӡ�ַ���
                            imagestring($dst_im,3,$src_w-130,$src_h-35,$waterstring,$white);//����ˮӡ
                            break;
                        case 2:    //��ˮӡͼƬ

                            $lim_size = getimagesize($waterimg);        //ȡ��ˮӡͼ��ߴ磬��Ϣ

                            switch($lim_size[2]) //�ж�ˮӡͼƬ�ļ�����
                            {
                                case 1://gif
                                    $src_lim = imagecreatefromgif($waterimg);  //ȡ��ˮӡͼ��
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
                                    die("��֧�ֵ��ļ�����");
                                    exit;
                                }

                                $src_lw = ($src_w-$lim_size[0])/2;  //ˮӡλ�ڱ���ͼ������width��λ
                                $src_lh = ($src_h-$lim_size[1])/2;  //height��λ

                                imagecopymerge($dst_im,$src_lim,$src_lw,$src_lh,0,0,$lim_size[0],$lim_size [1],$waterclearly);//�ϲ�����ͼ������ˮӡ͸����$waterclearly
                                imagedestroy($src_lim);
                                break;
                    }
                    switch($src_type)
                    {
                        case 1:
                            imagegif($dst_im,$all_path,$imclearly);//����gif�ļ���ͼƬ������0-100
                            break;
                        case 2:
                            imagejpeg($dst_im,$all_path,$imclearly);//����jpg�ļ���ͼƬ������0-100
                            break;
                        case 3:
                            imagepng($dst_im,$all_path,$imclearly);//����png�ļ���ͼƬ������0-100
                            break;
                        //case 6:
                        //imagewbmp($dst_im,$all_path);
                        break;
                    }
                    //�ͷŻ���
                    imagedestroy($dst_im);
                }

                if($smallmark == 1)
                {
                    $sall_path = $path_sim.time().".".$filetype;

                    if (file_exists($sall_path))
                    {
                        echo "ͬ���ļ��Ѿ�������";
                        exit;
                    }
					
					

                    if($src_w <= $dst_sw and $src_h <=130 ) // ԭͼ��ߴ� <= ����ͼ�ߴ�
                    {   
					    //if ($dst_sh>100){$dst_sh=100;};
                        $dst_sim = imagecreatetruecolor($src_w,$src_h); //�½�����ͼ���λͼ
                        imagecopymerge($dst_sim,$src_im,0,0,0,0,$src_w,$src_h,100); //ԭͼͼ��д���½����λͼ��
                    }else

                    //if($src_w > $dst_sw) // ԭͼ��ߴ� > ����ͼ�ߴ�
                    {
                        $dst_sh = $dst_sw/$src_w*$src_h; 
						if ($dst_sh>130){$dst_sh=130;$dst_sw=130*($src_w/$src_h);};
                        $dst_sim = imagecreatetruecolor($dst_sw,$dst_sh); //�½�����ͼ���λͼ���ȱ�����Сԭͼ�ߴ磩
                        imagecopyresampled($dst_sim,$src_im,0,0,0,0,$dst_sw,$dst_sh,$src_w,$src_h); //ԭͼͼ��д���½����λͼ��
                    }

                    switch($src_type)
                    {
                        case 1:
                            imagegif($dst_sim,$sall_path,$simclearly);//����gif�ļ���ͼƬ������0-100
                            break;
                        case 2:
                            imagejpeg($dst_sim,$sall_path,$simclearly);//����jpg�ļ���ͼƬ������0-100
                            break;
                        case 3:
                            imagepng($dst_sim,$sall_path,$simclearly);//����png�ļ���ͼƬ������0-100
                            break;
                        case 6:
                            imagewbmp($dst_sim,$sall_path);
                            break;
                        }
                        //�ͷŻ���
                        imagedestroy($dst_sim);
                    }

                    //�ͷŻ���
                    imagedestroy($src_im);
                }				
			$img=$sall_path;//����ͼ��ַ
			
$_SESSION[picallow]=$_SESSION[picallow]-1;		
$sql2="update `{$fkduo}user` set `picallow`=`picallow`-1 where (`logname`='$_SESSION[logname]') limit 1";
$query2=mysql_query($sql2);//�����û���ͼ����

                ?>