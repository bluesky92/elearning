<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }

$photo_avt = '';
if($row['img']!="" && $row['img']!="no") {
	$photo_avt = HOME_URL .'/uploads/product/' . str_replace(DS, '/', $row['folder']) . 'course-'. $row['img'];
} else {
	$photo_avt = HOME_URL .'/images/404-course.jpg';
}

$photo_avt = '<div class="image-course pull-left-prod" style="background-image: url(' . $photo_avt . ')"></div>';

echo '<div class="search-card">';
if(in_array($row['product_id'], $arr_like)) echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="1" class="wishlist-heart wishlisted" data-toggle="tooltip" data-placement="top" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
else echo '<div class="course-wishlist"><a href="javascript:;" onclick="return courses_like('. $row['product_id'] . ', $(this));" rel="0" class="wishlist-heart" data-toggle="tooltip" data-placement="top" title="Quan tâm"><div class="wishlist-heart-icon"><i class="fa fa-heart"></i></div></a></div>';
echo '<div class="rating" rel="' . $row['product_id'] . '">' . showRatings(floatval($row['vote'])/floatval($row['click_vote'])). '</div>';
echo '<a href="'. HOME_URL_LANG . '/' . $slug_cat . '/' . getSlugMenu($row['product_menu_id'], 'product') . '/' . $stringObj->getLinkHtml($row['name'], $row['product_id']) . '" title="' . stripslashes($row['name']) . '">';
echo '<div class="row no-margin">';
echo $photo_avt;
echo '<div class="content-course">';
echo '<div class="name-course">' . stripslashes($row['name']) . '</div>';
echo '<div class="about-author"><span>' . getNameTrainers($row['trainers']) . '</span></div>';
echo '<div class="ellipsis-2lines course-description"><span>' . stripslashes($row['comment']) . '</span></div>';
echo '</div>';
echo '</div>';
echo '</a>';
echo '</div>';