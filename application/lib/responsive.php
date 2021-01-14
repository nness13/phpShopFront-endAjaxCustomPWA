<?php
define('ROOT_DIR', dirname($_SERVER['DOCUMENT_ROOT']). '/public_html');

require_once(ROOT_DIR . '/application/lib/Upload.php');

$urlpreset = $_GET['preset'];
$file = $_GET['file'];

$filename = substr($file, 0 , (strrpos($file, ".")));
$format = substr($file, strrpos($file, "."));
$namenoscale = substr($file, 0, strrpos($file, "_"));
$nameload = "$namenoscale$format";

$image = new application\lib\Upload(ROOT_DIR . "/public/images/responsive/$urlpreset/$nameload");

$scale = $image->image_src_x*($_GET['scale']/100);

if ($_GET['scale'])
{
    $image->image_x = $scale;
    $image->image_ratio_y = true;
    $image->image_ratio_crop = true;
}
// ... другие пресеты ...
else
{
    die('error: no preset');
}


$image->image_resize = true;
$image->auto_create_dir = true;
$image->file_safe_name = false;
$image->file_overwrite = true;
$image->file_new_name_body   = $filename;
$image->process(ROOT_DIR . "/public/images/responsive/$urlpreset" );

if (!$image->processed)
{
    die('error: ' . $image->error);
}

header('Location: ' . "/public/images/responsive/$urlpreset/$file"  );
?>