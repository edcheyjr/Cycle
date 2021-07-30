<?php
/**
 * path of the file to renamed 
 * @param string $path
 * width you want it to be
 * @param  int $width 
 * height you want it to be
 * @param int $height 
 * whether you want the updates to take effect or not 
 * @param bool $update 
 * returns
 * @return string $path image[jpg,png,gif,jpeg]($path)
 */
 function resize_image($path,$old_x,$old_y, $new_width, $new_height, $update = false) {
   //  echo $path;
   $size  = getimagesize($path);// [width, height, type index]
   $types = array(1 => 'gif', 2 => 'jpeg', 3 => 'png', 4 => 'jpg');
   if ( array_key_exists($size['2'], $types) ) {
      // $load        = 'imagecreatefrom' . $types[$size['2']];
      $save        = 'image'. $types[$size['2']];
      // $image = $load($path);
      $image       = loadImage($types,$size,$path);
      // find the old width and old height one alternative
         // $old_y = imagesy($path);
         // $old_x = imagesy($path);
         
      // check the propotions of the image
      //php recommended
//       // Content type
// header('Content-Type: image/jpeg');

// // Get new dimensions
// list($width_orig, $height_orig) = getimagesize($filename);

// $ratio_orig = $width_orig/$height_orig;

// if ($width/$height > $ratio_orig) {
//    $width = $height*$ratio_orig;
// // } else {
// //    $height = $width/$ratio_orig;
// // }


            if($old_x > $old_y) 
         {
            $thumb_w    =   $new_width;
            $thumb_h    =   $old_y*($new_height/$old_x);
         }

         if($old_x < $old_y) 
         {
            $thumb_w    =   $old_x*($new_width/$old_y);
            $thumb_h    =   $new_height;
         }

         if($old_x == $old_y) 
         {
            $thumb_w    =   $new_width;
            $thumb_h    =   $new_height;
         } 

      $resized     = createTrueColors($new_width, $new_height);
      $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
      imagesavealpha($resized, true);
      imagefill($resized, 0, 0, $transparent);
      imagecopyresampled($resized,$image, 0, 0, 0, 0, $thumb_w, $thumb_h, $size['0'], $size['1']);
      imagedestroy($image);
      return $save($resized, $update ? $path : null);
   }
}


 function loadImage($types,$size,$imgname){
    /* Attempt to open */
   //  sinces their is no imagecreatefromjpg and technically jpg and jpeg are the same 
    if($types !== 'jpg'){
       $load = 'imagecreatefrom'.$types[$size['2']];
       $im = $load($imgname);
    }else{
       $im = imagecreatefromjpeg($imgname);
    }
    /* See if it failed */
    if(!$im)
    {
        /* Create a blank image */
        $im  = imagecreatetruecolor(150, 30);
        $bgc = imagecolorallocate($im, 255, 255, 255);
        $tc  = imagecolorallocate($im, 0, 0, 0);

        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

        /* Output an error message */
        @imagestring($im, 1, 5, 5, 'Error loading ' . $imgname, $tc);
    }

    return $im;
}

function createTrueColors($width, $height){
   
   $resized = @imagecreatetruecolor($width, $height)
      or die('Cannot Initialize new GD image stream');
      return $resized;
}