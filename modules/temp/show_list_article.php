<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

$photo_avt = '';
if($row['img']!="" && $row['img']!="no") {
	$photo_avt = HOME_URL .'/uploads/article/' . str_replace(DS, '/', $row['folder']) .'post-'. $row['img'];
} else {
	$photo_avt = HOME_URL .'/images/404-post.jpg';
}

$photo_avt = '<div class="image-course pull-left" style="background-image: url(' . $photo_avt . ')"></div>';
$time = '<div class="time"><i class="fa fa-calendar"></i> ' . $date->vnFull($row['created_time']) . '</div>';

echo '<div class="search-card">';
echo '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['article_menu_id'], 'article') . '/' . $stringObj->getLinkHtml($row['name'], $row['article_id']) . '" title="' . stripslashes($row['name']) . '">';
echo '<div class="row no-margin">';
echo $photo_avt;
echo '<div class="content-course">';
echo '<div class="name-course">' . stripslashes($row['name']) . '</div>';
echo $time;
echo '<div class="post-comment"><span>' . stripslashes($row['comment']) . '</span></div>';
echo '</div>';
echo '</div>';
echo '</a>';
echo '</div>';