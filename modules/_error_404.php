<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$title = $lgTxt_error_page;
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = $breadcrumb_menu_parent = $breadcrumb_menu = '';
$breadcrumb_category = '<li><a class="error" href="' . HOME_URL_LANG . '" title="' . $lgTxt_error_page . '">' . $lgTxt_error_page . '</a></li>';
?>
<main class="category">
    <div class="row no-margin category-header">
        <div class="row container">
            <?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . '</ul>';?>
            <div class="row no-margin category-header-name"><?php echo '<h2>' . $title . '</h2>';?></div>
        </div>
    </div>
    <div class="row no-margin category-all-courses">
        <div class="container">
            <div class="col-lg-3 col-md-3 col-sm-12 no-padding category-all-courses-left">
                <div class="row other-category-container hidden-sm">
                    <?php
                    $slug = getSlugCategory(89);
                    $db->table = "product_menu";
                    $db->condition = "`is_active` = 1 AND `parent` = 0 AND `category_id` = 89";
                    $db->order = "`sort` ASC";
                    $db->limit = "";
                    $rows = $db->select();
                    if ($db->RowCount > 0) {
                        echo '<ul class="row no-margin other-category">';
                        foreach ($rows as $row) {
                            echo '<li><a class="other-category-item" href="' . HOME_URL_LANG . '/' . $slug . '/' . stripslashes($row['slug']) . '" title="' . stripslashes($row['name']) . '">' . stripslashes($row['name']) . '</a>' . loadMenu($slug, $row['product_menu_id']) . '</li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="error404">
                    <p><?php echo $lgTxt_page404;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_page404_click;?></a> <?php echo $lgTxt_page404_back;?> <a href="<?php echo HOME_URL_LANG;?>"><?php echo $lgTxt_menu_home;?></a>.</p>
                    <p><i class="fa fa-warning color-red"></i></p>
                </div>
            </div>
        </div>
    </div>
</main>