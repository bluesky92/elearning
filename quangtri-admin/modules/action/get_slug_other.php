<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
if(isset($_POST['name'])) {
	$name = $_POST['name'];
	$stringObj = new StringClass();
	$slug = $stringObj->getSlug($name);
	echo $slug;
}
if(isset($_POST['link2Documents'])) {
	$link2Documents = $_POST['link2Documents'];
}