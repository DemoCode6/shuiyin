<?php
    if ($_FILES) {
        // print_r($_FILES);die;
        // 设置路径，存储图片
        $img_name = $_FILES['file']['name'];// 文件名
        $tmp_path = $_FILES['file']['tmp_name'];// 临时位置
        $path = "img/" . $img_name;// 要存放的位置
        move_uploaded_file($tmp_path,$path);// 移动文件致

        // 给图片设置水印
        // 获取图片信息  
        $info = getimagesize($path);  
        // print_r($info);die;
        // 获取图片后缀名,false代表不要.jpg的点
        $type = image_type_to_extension($info[2],false);  
        //创建和图像类型一样的图像
        $fun = "imagecreatefrom".$type;  
        //5.创建图片
        $image = $fun($path);  

        /*操作图片*/  
        //1.设置字体的路径  
        $font = "simhei.ttf";  
        //2.填写水印内容  
        $content = $_POST['text'];  
        //3.设置字体颜色和透明度  
        $color = imagecolorallocatealpha($image, 255, 255, 255, 0);  
        //4.写入文字 (图片资源，字体大小，旋转角度，坐标x，坐标y，颜色，字体文件，内容) 
        imagettftext($image, 20, 0, 100, 100, $color, $font, $content);  

        /*输出图片*/  
        //浏览器专业输出图片的header头  
        header("Content-type:".$info['mime']);  
        $fun2 = "image".$type;  //imagejpge()
        $fun2($image);  
        //保存图片  图片位置
        $fun2($image,'img/'.$img_name.'.'.$type);  
        /*销毁图片*/  
        imagedestroy($image);

    } else {
        echo "还没有传文件";
    }
