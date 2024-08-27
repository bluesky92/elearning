<?php
if (!defined("TTH_SYSTEM")) { die("Please stop!"); }
//
$breadcrumb_home = '<li class="breadcrumb-home"><a href="'. HOME_URL_LANG . '/home' . '" title="' . $lgTxt_menu_home . '"><i class="fa fa-home"></i>&nbsp; ' . $lgTxt_menu_home . '</a></li>';
$breadcrumb_category = '<li><a href="' . HOME_URL_LANG . '/examination" title="Kỳ kiểm tra">Kỳ kiểm tra</a></li>';
?>
<main class="home">
    <div class="row no-margin category-header">
        <div class="row container">
            <?php echo '<ul class="no-padding breadcrumb">' . $breadcrumb_home . $breadcrumb_category . '</ul>';?>
            <div class="row no-margin category-header-name">
                <h2>Kỳ kiểm tra</h2>
            </div>
        </div>
    </div>
    <div class="row no-margin faq-container container-main">
        <div class="box-1">
            <!-- <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="  search-query form-control" placeholder="Tìm kiếm" />
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <h3>Danh mục</h3>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1">
                    Tất cả
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Đang diễn ra
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" >
                <label class="form-check-label" for="flexRadioDefault3">
                    Sắp diễn ra
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" >
                <label class="form-check-label" for="flexRadioDefault4">
                    Đã kết thúc
                </label>
            </div> -->
        </div>
        <div class="container box-2">
            <?php
            if($account["id"]>0) {
                $date = new DateClass();

                $db->table = "examination";
                $db->condition = "`is_active` = 1 AND `to_role` IN (SELECT `role_id` FROM `" . TTH_DATA_PREFIX . "core_user` WHERE `user_id` = " . $account["id"] . ")";
                $db->order = "`start` DESC";
                $db->limit = "";
                $db->select();
                $total = $db->RowCount;
				//var_dump($account);
				// echo("total: ".$total);
                echo '<div class="sort-content">
                    <p class="sort-content-1" style= "font-size:24px; font-weight: 800;">
                    <svg width="30" viewBox="0 0 32 31" fill="none" xmlns="http://www.w3.org/2000/svg" color="#FFAE43"><path d="M31.5 26.5625L25.0312 2.4063C24.8592 1.7661 24.4399 1.22045 23.8656 0.88935C23.2913 0.558246 22.609 0.468796 21.9688 0.640671L17.1406 1.93755L16.9844 1.98442C16.7515 1.67891 16.4513 1.43118 16.1072 1.26046C15.763 1.08974 15.3842 1.00063 15 1.00005H10C9.56015 1.00123 9.1286 1.1199 8.75 1.3438C8.3714 1.1199 7.93985 1.00123 7.5 1.00005H2.5C1.83696 1.00005 1.20107 1.26344 0.732233 1.73228C0.263392 2.20112 0 2.837 0 3.50005V28.5C0 29.1631 0.263392 29.799 0.732233 30.2678C1.20107 30.7367 1.83696 31 2.5 31H7.5C7.93985 30.9989 8.3714 30.8802 8.75 30.6563C9.1286 30.8802 9.56015 30.9989 10 31H15C15.663 31 16.2989 30.7367 16.7678 30.2678C17.2366 29.799 17.5 29.1631 17.5 28.5V12.9375L21.8438 29.1407C21.9853 29.6746 22.2997 30.1466 22.7379 30.483C23.176 30.8194 23.7132 31.0012 24.2656 31C24.4813 30.9963 24.696 30.9701 24.9062 30.9219L29.7344 29.625C30.3746 29.453 30.9202 29.0337 31.2513 28.4594C31.5824 27.8851 31.6719 27.2028 31.5 26.5625ZM22.6094 3.06255L23.5938 6.67192L18.7656 7.9688L17.7812 4.35942L22.6094 3.06255ZM15 3.50005V22.25H10V3.50005H15ZM7.5 3.50005V7.25005H2.5V3.50005H7.5ZM15 28.5H10V24.75H15V28.5ZM29.0938 27.2032L24.2656 28.5L23.2812 24.875L28.125 23.5782L29.0938 27.2032Z" fill="#FFAE43"></path></svg>
                        Tất cả bài kiểm tra: ' . $total . '
                    </p>
                    <p class="pull-right">
                        <!--div class="dropdown-exam">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sắp xếp theo
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Ngày kiểm tra gần nhất</a></li>
                                <li><a href="#">Ngày kiểm tra xa nhất</a></li>
                            </ul>
                        </div--!>
                    </p>
                </div>';
                if($total>0) {
                    $total_pages = 0;
                    $per_page = 10;
                    if($total%$per_page==0) $total_pages = $total/$per_page;
                    else $total_pages = floor($total/$per_page)+1;
                    if($page<=0) $page=1;
                    $start=($page-1)*$per_page;

                    $db->table = "examination";
                    $db->condition = "`is_active` = 1 AND `to_role` IN (SELECT `role_id` FROM `" . TTH_DATA_PREFIX . "core_user` WHERE `user_id` = " . $account["id"] . ")";
                    $db->order = "`start` DESC";
                    $db->limit = $start . ", " . $per_page;
                    $rows = $db->select();

                    echo '<div class="faq-content"><ul class="examination">';
                    foreach($rows as $row) {
                        // echo '<li>
                        //         <a data-target="#el-modal" data-toggle="modal" href="javascript:;" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination\');"><i class="fa fa-chevron-right"></i> ' . stripslashes($row['title']) . '</a>
                        //         <p class="info"><label><span>Chủ đề khóa học:</span> '  . getNameProductMenu($row['product_menu_id']) . '</label> - <label><span>Khóa học:</span> '  . getNameProductExa($row['product_id']) . '</label> - <label><span>Số câu hỏi:</span> '  . intval($row['count']) . '</label> - <label><span>Thời gian làm bài:</span> '  . intval($row['time']) . ' (phút)</label> - <label><span>Lúc bắt đầu:</span> <strong class="start">'  . $date->vnDateTime($row['start']) . '</strong></label> - <label><span>Người tạo:</span> '  . getUserFullName($row['user_id']) . '</label></p>
                        //     </li>';
                        echo '<a data-target="#el-modal" data-toggle="modal" href="javascript:;" onclick="return open_modal(' . intval($row['examination_id']) . ', \'examination\');">
                                <div class="ant-col">
                                    <span clasa="ant-col-2">
                                        <span class="ant-col-3">
                                            <div class="ant-col-4">
                                                <div class="image-container">
                                                    <img src="https://lyluanchinhtri-statics.melisoft.vn/2024/06/14/img_cd4_1717565254148_1718078870266_1718337593423.jpg">
                                                </div>
                                                <div class="item-wrap-info">
                                                    <div>
                                                        <div class="item-wrap-1-1">
                                                            <span class="item-span-wrap">
                                                                Thời gian bắt đầu: '  . $date->vnDateTime($row['start']) . '
                                                            </span>
                                                        </div>
                                                        <h3 class="item-wrap-1-2">
                                                            <span>
                                                                '.stripslashes($row['title']).'
                                                            </span> 
                                                        </h3>
                                                        <h3 class="item-wrap-1-3">
                                                            <span class="text-limit">
                                                                ' . getNameProductExa($row['product_id']) . '
                                                            </span> 
                                                        </h3>
                                                        <div>
                                                            <div class="item-wrap-2-1">
                                                                <span class="glyphicon glyphicon-user"></span> Người tạo: ' . getUserFullName($row['user_id']) . '
                                                            </div>
                                                            <div class="item-wrap-2-1">
                                                                <svg width="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_4946_21463)"><path d="M7.5 7.5C7.5 4.58333 12.0833 4.58333 12.0833 7.5C12.0833 9.58333 10 9.16667 10 11.6667M10 15.0083L10.0083 14.9992" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.99935 18.3327C14.6018 18.3327 18.3327 14.6018 18.3327 9.99935C18.3327 5.39685 14.6018 1.66602 9.99935 1.66602C5.39685 1.66602 1.66602 5.39685 1.66602 9.99935C1.66602 11.5168 2.07185 12.941 2.78102 14.166L2.08268 17.916L5.83268 17.2177C7.09897 17.9502 8.53644 18.3349 9.99935 18.3327Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_4946_21463"><rect width="20" height="20" fill="white"></rect></clipPath></defs></svg>
                                                            
                                                                </span> Số câu hỏi: ' . intval($row['count']) . ' câu
                                                            </div>
                                                            <div class="item-wrap-2-1">
                                                                <span class="glyphicon glyphicon-time"></span> Thời gian làm bài: ' . intval($row['time']) . ' phút
                                                            </div>
                                                            <!--div class="item-wrap-2-2">
                                                                <i class="fa fa-chevron-right"></i>Chi tiết kết quả: ' . stripslashes($row['title']) . '
                                                            </div--!>        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </span>
                                </div>
                                </a>';
                    }
                    echo '</ul></div>';

                    showPageNavigation($page, $total_pages, HOME_URL_LANG . '/examination?p=');
                }
            }
            ?>
        </div>
    </div>
</main>