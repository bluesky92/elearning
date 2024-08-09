<?php
// System
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//---
$USER           = getInfoUser($account["id"]);
if(empty($_FILES['file'])|| empty($USER)) {
	exit();
}
$stringObj      = new StringClass();
$date           = new DateClass();
$file_max_size  = FILE_MAX_SIZE;
$dir_dest       = ROOT_DIR . DS . 'uploads' . DS . 'forum' . DS;
$s_folder       = $USER[6] . DS . $date->vnOther(time(), 'm-Y') . DS;
$name_image     = substr(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME), 0, 100) . '_' . time();
$errorImgFile   = '/images/error.jpg';

$imgUp = new Upload($_FILES['file']);
$imgUp->file_max_size = $file_max_size;
if($imgUp->uploaded) {
	$imgUp->file_new_name_body = $name_image;
	$imgUp->Process($dir_dest . $s_folder);
	$images = $imgUp->file_dst_name;
	$imgUp->Clean();
	echo '/uploads/forum/' . str_replace(DS, '/', $s_folder) . $images;
} else {
	echo $errorImgFile;
}