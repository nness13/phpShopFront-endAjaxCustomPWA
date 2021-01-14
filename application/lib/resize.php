<?php
define('ROOT_DIR', dirname($_SERVER['DOCUMENT_ROOT']). '/public_html');

require_once(ROOT_DIR . '/application/lib/Upload.php');

if ( !in_array($_GET['preset'], array('default_img', 'goods', 'portfolio')) ) {
    die('error: no preset');
    }

$urlpreset = $_GET['preset'];
$file = $_GET['file'];
//exit($_GET);
$filename = substr($file, 0 , (strrpos($file, ".")));
$format = substr($file, strrpos($file, "."));
$namenoscale = substr($file, 0, strrpos($file, "_"));
$nameload = "$namenoscale$format";

$image = new application\lib\Upload(ROOT_DIR . "/materials/responsive/$urlpreset/$nameload");

//exit($_GET['scale']);

if ($_GET['scale']) {
    $orientation = substr($_GET['scale'], 0, 1);
    $cou = iconv_strlen($_GET['scale']);
    if($cou-3 >= 0){
        for($i=0; $i < ($cou-3); $i++ ){
            $nuliv .= '0';
        }
        $scale = substr($_GET['scale'], 1, 2).$nuliv;
    }else{
        die('error: no preset');
    }

    if($orientation == 'w'){
        $image->image_x = $scale;
        $image->image_ratio_y = true;
        $image->image_ratio_crop = true;
    }elseif ($orientation == 'h'){
        $image->image_y = $scale;
        $image->image_ratio_x = true;
        $image->image_ratio_crop = true;
    }

}else {
    die('error: no preset');
}
 

$image->image_resize = true;
$image->auto_create_dir = true;
$image->file_safe_name = false;
$image->file_overwrite = true;
$image->file_new_name_body   = $filename;
$image->process(ROOT_DIR . "/materials/responsive/$urlpreset" );
 
if (!$image->processed)
{
    die('error: ' . $image->error);
}
 
header('Location: ' . "/materials/responsive/$urlpreset/$file"  );
?>