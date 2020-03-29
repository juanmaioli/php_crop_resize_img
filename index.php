<?php
//Created by Juan Maioli
//Crop And Resize image functions
$image_arch = 'img.jpg';
$tamaño = getimagesize($image_arch);
$image_width = $tamaño[0];
$image_height = $tamaño[1];
$image_new_width = 500;
$image_new_height = 500;
$image_center_X = $image_width/2 - $image_new_width/2;
$image_center_Y = $image_height/2  - $image_new_height/2;

function crop_image($image_full,$X,$Y,$W,$H)
{
    $src_image = imagecreatefromjpeg($image_full);
    $imgCrop = imagecrop($src_image, ['x' => $X , 'y' => $Y , 'width' => $W , 'height' => $W]);
    if ($imgCrop !== FALSE) {
        imagejpeg($imgCrop, 'cropped_'. $image_full);
        imagedestroy($imgCrop);
        echo "Image cropped successfully";
    }
    imagedestroy($src_image);
}

function resize_image($image_full,$src_w,$src_h){
    $src_image = imagecreatefromjpeg($image_full);
    $dst_w= round($src_w*3,0);
    $dst_h= round($src_h*3,0);
    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    $dst_x = 0; 
    $dst_y = 0;
    $src_x = 0;
    $src_y = 0;
    $imgResize = imagecopyresampled ($dst_image,$src_image,$dst_x ,$dst_y,$src_x,$src_y,$dst_w,$dst_h,$src_w,$src_h);

    if ($imgResize!== FALSE) {
        imagejpeg($dst_image, 'resize_' . $image_full);
        echo "Image resize successfully";
        imagedestroy($src_image);
    }
}

crop_image($image_arch,$image_center_X,$image_center_Y,$image_new_width,$image_new_height);
resize_image($image_arch,$image_width,$image_height);


?>