<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
//Function __autoload()
function __autoload($classname) {
	if (file_exists(_F_CLASSES . DS . $classname . ".class.php")) {
		include(_F_CLASSES . DS . $classname . ".class.php");
	}
	else if (file_exists(_F_CLASSES . DS . $classname . ".php")) {
		include(_F_CLASSES . DS . $classname . ".php");
	}
	else if (file_exists(_F_CLASSES . DS . "class." . $classname . ".php")) {
		include(_F_CLASSES . DS . "class." . $classname . ".php");
	}
    else if (file_exists(_F_CLASSES . DS . str_replace('_', DS, $classname) . ".php")) {
	    include(_F_CLASSES . DS . str_replace('_', DS, $classname) . ".php");
    }
    else {
    }
}

//----------------------------------------------------------------------------------------------------------------------
/*	Checking Development Enviroment
	Set Reporting Error */
function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }
    else {
        error_reporting(E_ALL);
        ini_set('display_errors', 'Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ERROR_LOG_DIR);
    }
}
setReporting();

//----------------------------------------------------------------------------------------------------------------------
/** Hàm lấy giá trị bảng constant
 * @param $const
 * @return string
 */
function getConstant($const) {
	global $db;
	$const = $db->clearText($const);

	$value = '';
	$db->table = "constant";
	$db->condition = "constant = '".$const."'";
	$db->order = "";
	$rows = $db->select();
	foreach($rows as $row){
		$value = $row['value'];
	}

	return stripslashes($value);
}

//----------------------------------------------------------------------------------------------------------------------
/** Hàm gửi Mail
 * @param $emailReply
 * @param $nameReply
 * @param $nguoinhan
 * @param $namenguoinhan
 * @param $tieude
 * @param $noidung
 * @return bool
 */
function sendMailFn($emailReply, $nameReply, $emailTo, $nameTo, $subject, $content, $file = '', $emailTo2 = '' , $nameTo2 = '') {
	$content =	str_replace("\n"	, "<br>"	, $content);
	$content =	str_replace("  "	, "&nbsp; "	, $content);
	$content =	str_replace("<script>","&lt;script&gt;", $content);

	//Khởi tạo đối tượng
	$mail = new PHPMailer();
	$mail->IsSMTP();

	$mail->Host = getConstant("SMTP_host");
	$mail->Port = getConstant("SMTP_port");
	$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
	// 1 = errors and messages
	// 2 = messages only
	$mail->SMTPAuth = true;
	(getConstant("SMTP_secure")!="none") ? $mail->SMTPSecure = getConstant("SMTP_secure") : "";
	$mail->Username = getConstant("SMTP_username");
	$mail->Password = getConstant("SMTP_password");

	$mail->SetFrom($mail->Username,getConstant("SMTP_mailname"));

	$mail->AddAddress($emailTo, $nameTo);
	if($emailTo2!="") {
		$mail->AddAddress($emailTo2, $nameTo2);
	}
	$mail->AddReplyTo($emailReply, $nameReply);

	$mail->Subject = $subject;
	$mail->CharSet = "utf-8";
	$body = $content;
	$mail->Body = $body;
	($file!='') ? $mail->AddAttachment($file) : "";
	$mail->IsHTML(true); 
	
	if(!$mail->Send()) {
		return FALSE;
	} else {
		return TRUE;
	}
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param $str
 * @param $url
 */
function loadPageAdmin($str, $url) {
?>
    <div align="center">
	    <div id="spinningSquaresG">
		    <div id="spinningSquaresG_1" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_2" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_3" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_4" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_5" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_6" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_7" class="spinningSquaresG">
		    </div>
		    <div id="spinningSquaresG_8" class="spinningSquaresG">
		    </div>
	    </div>
	    <span class="show-error"><?php echo $str?></span>
        <br>Vui lòng đợi giây lát hoặc bấm <a style="font-weight:  bold;" href="<?php echo $url?>">vào đây</a> để tiếp tục...
    </div>
    <head>
        <meta http-equiv="Refresh" content="5; URL=<?php echo $url?>">
    </head>
<?php
   die();
}

/**
 * @param $str
 * @param $url
 */
function loadPageSucces($str, $url) {
	?>
	<div align="center">
		<div id="spinningSquaresG">
			<div id="spinningSquaresG_1" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_2" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_3" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_4" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_5" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_6" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_7" class="spinningSquaresG">
			</div>
			<div id="spinningSquaresG_8" class="spinningSquaresG">
			</div>
		</div>
		<span class="show-ok"><?php echo $str?></span>
		<br>Vui lòng đợi giây lát hoặc bấm <a style="font-weight:  bold;" href="<?php echo $url?>">vào đây</a> để tiếp tục...
	</div>
	<head>
		<meta http-equiv="Refresh" content="1; URL=<?php echo $url?>">
	</head>
	<?php
	die();
}

function dashboardCoreAdmin() {
	global $tth, $corePrivilegeSlug;
	if(!in_array($tth,$corePrivilegeSlug)) loadPageAdmin("Bạn không được phân quyền với chức năng này.", ADMIN_DIR);
}

function dashboardCoreAdminTwo($path) {
	global $corePrivilegeSlug;
	if(!in_array($path,$corePrivilegeSlug)) loadPageAdmin("Bạn không được phân quyền với chức năng này.", ADMIN_DIR);
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param int $length
 * @return string
 */
function getRandomString($length = 15) {
	$validCharacters = "abcdefghijklmnopqrstuxyvwz0123456789";
	$validCharNumber = strlen($validCharacters);

	$result = "";

	for ($i = 0; $i < $length; $i++) {
		$index = mt_rand(0, $validCharNumber - 1);
		$result .= $validCharacters[$index];
	}

	return $result;
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param $currentPage
 * @param $maxPage
 * @param string $path
 */
function showPageNavigation($currentPage, $maxPage, $path = '') {
	if ($maxPage <= 1) {
		return;
	}
	$nav = array(
		'left'	=>	3,
		'right'	=>	3,
	);

	if ($maxPage < $currentPage) {
		$currentPage = $maxPage;
	}
	$max = $nav['left'] + $nav['right'];
	if ($max >= $maxPage) {
		$start = 1;
		$end = $maxPage;
	}
	elseif ($currentPage - $nav['left'] <= 0) {
		$start = 1;
		$end = $max + 1;
	}
	elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
		$start = $maxPage - $max;
		$end = $maxPage;
	}
	else {
		$start = $currentPage - $nav['left'];
		if ($start == 2) {
			$start = 1;
		}

		$end = $start + $max;
		if ($end == $maxPage - 1) {
			++$end;
		}
	}

	$navig = '<div class="page-navigation"><ul class="pagination">';
	if ($currentPage >= 2) {
		if ($currentPage >= $nav['left']) {
			if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
				$navig .= '<li class="paginate_button"><a href="'.$path.'1">1</a></li>';
				$navig .= '<li class="paginate_button"><a>...</a></li>';
			}
		}
		$navig .= '<li class="paginate_button"><a href="'.$path.($currentPage - 1).'"><i class="fa fa-step-backward"></i></a></li>';
	}

	for ($i=$start;$i<=$end;$i++) {
		if ($i == $currentPage) {
			$navig .= '<li class="paginate_button active"><a>'.$i.'</a></li>';
		}
		else {
			$pg_link = $path.$i;
			$navig .= '<li class="paginate_button"><a href="'.$pg_link.'">'.$i.'</a></li>';
		}
	}

	if ($currentPage <= $maxPage - 1) {
		$navig .= '<li class="paginate_button"><a href="'.$path.($currentPage + 1).'"><i class="fa fa-step-forward"></i></a></li>';

		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			$navig .= '<li class="paginate_button"><a>...</a></li>';
			$navig .= '<li class="paginate_button"><a href="'.$path.$maxPage.'">'.$maxPage.'</a></li>';
		}
	}
	$navig .= '</ul></div>';

	echo $navig;
}

//----------------------------------------------------------------------------------------------------------------------
function getCurrentDir($path=".") {
	$dirarr = array();
	if ($dir = opendir($path)) {
		while (false !== ($entry = @readdir($dir))) {
			if (($entry!=".")&&($entry!="..")) {
				if ($path!=".") $newpath = $entry;
				else $newpath = $entry;
				$newpath = str_replace("//","/",$newpath);
				$dirarr[] = $newpath;
			}
		}
	}
	return $dirarr;
}// end func

//----------------------------------------------------------------------------------------------------------------------
function size_format($bytes="") {
	$retval = "";
	if ($bytes >=  pow(1024,5)) {
		$retval = round($bytes / pow(1024,5) * 100 ) / 100 . " PB";
	} else if ($bytes >=  pow(1024,4)) {
		$retval = round($bytes / pow(1024,4) * 100 ) / 100 . " TB";
	} else if ($bytes >=  pow(1024,3)) {
		$retval = round($bytes / pow(1024,3) * 100 ) / 100 . " GB";
	} else if ($bytes >=  pow(1024,2)) {
		$retval = round($bytes / pow(1024,2) * 100 ) / 100 . " MB";
	} else if ($bytes  >= 1024) {
		$retval = round($bytes / 1024 * 100 ) / 100 . " KB";
	} else {
		$retval = $bytes . " bytes";
	}
	return $retval;
}

function convert_to_bytes( $string ) {
	if(preg_match( '/^([0-9\.]+)[ ]*([b|k|m|g|t|p|e|z|y]*)/i', $string, $matches)) {
		if( empty( $matches[2] ) ) return $matches[1];
		$suffixes = array(
			'B' => 0,
			'K' => 1,
			'M' => 2,
			'G' => 3,
			'T' => 4,
			'P' => 5,
			'E' => 6,
			'Z' => 7,
			'Y' => 8
		);
		if(isset($suffixes[strtoupper( $matches[2])])) return round($matches[1] * pow(1024, $suffixes[strtoupper( $matches[2])]));
	}
	return false;
}

function convert_from_bytes($size){
	if($size <= 0) return '0 bytes';
	if($size == 1) return '1 byte';
	if($size < 1024) return $size . ' bytes';
	$i = 0;
	$iec = array( 'bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' );
	while(($size / 1024) >= 1){
		$size = $size / 1024;
		++$i;
	}
	return number_format( $size, 2 ) . ' ' . $iec[$i];
}
//----------------------------------------------------------------------------------------------------------------------
/** Đếm tổng số truy cập
 * @return int
 */
function getTotalHits() {
	global $db;
	$data = 0;

	$db->table = "online_daily";
	$db->condition = 1;
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	foreach ($rows as $row){
		$data += $row["count"]+0;
	}
	return formatNumberVN($data);
}

//----------------------------------------------------------------------------------------------------------------------
/** Lấy thông tin User
 * @param int $id
 * @return array
 * @throws DatabaseConnException
 */
function getInfoUser($id = 0) {
	global $db;
	$info = array();
	$db->table = "core_user";
	$db->condition = "user_id = " . ($id+0);
	$db->order = "";
	$db->limit = 1;
	$rows = $db->select();
	foreach($rows as $row) {
		$info[0] = stripslashes($row['full_name']);
		$info[1] = stripslashes($row['apply']);
		$info[2] = stripslashes($row['phone']);
		$info[3] = stripslashes($row['email']);
		if($row['img']=='no' || $row['img']=='' ) {
			$info[4] = '/uploads/user/no-avatar-' .  ($row['gender']+0) . '.png';
			$info[4] = '<img src="' . $info[4] . '" title="' . stripslashes($row['full_name']) . '" >';
		} else {
			$info[4] = '/uploads/user/sm_' . $row['img'];
			$info[4] = '<img src="' . $info[4] . '" title="' . stripslashes($row['full_name']) . '" >';
		}
		$info[5] = stripslashes($row['role_id']);
		$info[6] = stripslashes($row['user_name']);
	}
	return $info;
}

//----------------------------------------------------------------------------------------------------------------------
/** Tính tổng bài viết
 * @return string
 */
function getTotalArticle() {
	global $db;
	$db->table = "article";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

//----------------------------------------------------------------------------------------------------------------------
/** Tính tổng sản phẩm
 * @return string
 */
function getTotalProduct() {
	global $db;
	$db->table = "product";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

//----------------------------------------------------------------------------------------------------------------------
/** Tính tổng dự án
 * @return string
 */
function getTotalProject() {
	global $db;
	$db->table = "project_menu";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

//----------------------------------------------------------------------------------------------------------------------
/** Tính tổng đường
 * @return string
 */
function getTotalStreet() {
	global $db;
	$db->table = "street";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

//----------------------------------------------------------------------------------------------------------------------
/** Tính tổng tên dự án
 * @return string
 */
function getTotalNameProject() {
	global $db;
	$db->table = "prjname";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

function countProductZe($id) {
	global $db;
	$count = 0;

	$db->table = "product";
	$db->condition = "product_menu_id = " . ($id+0);
	$db->order = "";
	$db->limit = "";
	$db->select();
	$count = $db->RowCount;
	return $count;
}

//----------------------------------------------------------------------------------------------------------------------
function getTotalUser() {
	global $db;
	$db->table = "core_user";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}
function getTotalRole() {
	global $db;
	$db->table = "core_role";
	$db->condition = "";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param array $currentdir
 * @param $dir_dest
 */
function showFileBackupData(array $currentdir, $dir_dest) {
	?>
	<table class="table table-manager table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th>STT</th>
			<th>Tên file</th>
			<th>Dung lương</th>
			<th>Thời gian</th>
			<th>Chức năng</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$date = new DateClass();
		$string = array();
		$timefile = time();
		for ($i=0;$i<count($currentdir);$i++) {
			$entry = $currentdir[$i];
			if (!is_dir($entry)) {
				$name = $entry;
				$string = explode("_",$name);
				$filesize = @filesize($dir_dest."/".$name);
				$timefile = str_replace(".sql.gz","",$string[1]);
				$timefile = str_replace(".gz","",$timefile);
				$timefile = str_replace(".sql","",$timefile);
				?>
				<tr>
					<td align="center"><?php echo $i+1?></td>
					<td><?php echo $string[1]?></td>
					<td align="right"><?php echo size_format($filesize)?></td>
					<td align="center"><?php echo $date->vnFull($timefile)?></td>
					<td align="center">
						<a  data-toggle="tooltip" data-placement="left" title="Tải xuống" href="download.php?<?php echo TTH_PATH?>=<?php echo $dir_dest?>&filename=<?php echo $name?>" ><img src="images/download.png"></a>&nbsp;&nbsp;
						<a  data-toggle="tooltip" data-placement="right" title="Xóa file" class="confirmManager" style="cursor: pointer;" id="?<?php echo TTH_PATH?>=backup_data&filename=<?php echo $name?>" ><img src="images/remove.png"></a>
					</td>
				</tr>
			<?php
			}
		} ?>
		</tbody>
	</table>
	<script>
		$(".confirmManager").click(function() {
			var element = $(this);
			var action = element.attr("id");
			confirm("File sao lưu cơ sở dữ liệu này sẽ được xóa và không thể phục hồi lại nó.\nBạn có muốn thực hiện không?", function() {
				if(this.data == true) window.location.href = action;
			});
		});
	</script>
<?php
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param $url
 * @param $filename
 * @param $dir
 * @return bool
 */
function uploadVideo($url, $filename , $dir)
{
	$test = false;
	$url = 'http://img.youtube.com/vi/'.$url.'/hqdefault.jpg';
	define("URL_1", $url);

	$UploadDir =  $dir;

	define("URL_2", $UploadDir.$filename.".jpg");
	$f1 = @fopen ( URL_1, "rb");
	$f2 = @fopen ( URL_2, "w");
	while ( $Buff = @fread( $f1, 1024 ) ) {
		@fwrite($f2, $Buff);
		$test = true;
	}
	@fclose($f1);
	@fclose($f2);

	return $test;
}

//----------------------------------------------------------------------------------------------------------------------
/**
 * @param $text
 * @return mixed
 */
function formatNumberToInt($text) {
	$text = str_replace(".", "", $text);
	return $text+0;
}

function formatNumberToFloat($text) {
	$text = str_replace(".", "", $text);
	$text = str_replace(",", ".", $text);
	return $text+0;
}

/**
 * @param $num
 * @return string
 */
function formatNumberVN($num) {
	return number_format(($num+0),0,"",".");
}

function countForumComments($id) {
	global $db;
	$db->table = "forum_comment";
	$db->condition = "`forum_id` = $id";
	$db->order = "";
	$db->limit = "";
	$db->select();
	return formatNumberVN($db->RowCount);
}

function getSlugCategory($id) {
	global $db;
	$slug = "";

	$db->table = "category";
	$db->condition = "category_id = ".($id+0);
	$db->order = "";
	$db->limit = "";
	$rows = $db->select('slug');

	foreach($rows as $row) {
		$slug = $row['slug'];
	}

	return stripslashes($slug);
}


function convertTimeAgo($time) {
	date_default_timezone_set(TTH_TIMEZONE);
	$result = '';
	$time = time() - $time;
	if($time>0) {
		if($time<60) $result = $time . ' giây trước';
		elseif($time<3600) $result = round($time/60) . ' phút trước';
		elseif($time<86400) $result = round($time/3600) . ' giờ trước';
		elseif($time<604800) $result = round($time/86400) . ' ngày trước';
		elseif($time<2592000) $result = round($time/604800) . ' tuần trước';
		elseif($time<31536000) $result = round($time/2592000) . ' tháng trước';
		else $result = round($time/31536000) . ' năm trước';
	} else {
		$result = 'mới xong';
	}

	return $result;
}

function convertTime5DayAgo($time, $t1 = '', $t2 = '') {
	date_default_timezone_set(TTH_TIMEZONE);
	global $date;
	if((time() - $time)>432000) return $t1 . $date->vnFull($time);
	else return $t2 . convertTimeAgo($time);
}

function insertNotify($msg, $type, $post, $user, $category=0) {
    global $db;
    $current_time = time();

    $db->table = "notify";
    $data = array(
        'msg' => $msg,
        'type' => $db->clearText($type),
        'post' => $post,
        'created_time' => $current_time,
        'user_id' => $user
    );
    $db->insert($data);
    $notify_id = $db->LastInsertID;

    $list_user = array();
    if($type=='product') {
        array_push($list_user, $user);
        //---
        $db->table = "product_logs";
        $db->condition = "`product_id` = $post";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            if($row['user_id']>0) {
                array_push($list_user, $row['user_id']);
            }
        }
    } elseif($type=='forum') {
        array_push($list_user, $user);
        //---
        $db->table = "forum";
        $db->condition = "`forum_id` = $post";
        $db->order = "";
        $db->limit = 1;
        $db->select();
        if($db->RowCount>0) {
            //---
            $rows = $db->select();
            foreach ($rows as $row) {
                if($row['user_id']>0) {
                    array_push($list_user, $row['user_id']);
                }
                if($row['modified_user']>0) {
                    array_push($list_user, $row['modified_user']);
                }
            }
            //---
            $db->table = "forum_like";
            $db->condition = "`forum_id` = $post";
            $db->order = "";
            $db->limit = "";
            $rows = $db->select();
            foreach ($rows as $row) {
                if($row['user_id']>0) {
                    array_push($list_user, $row['user_id']);
                }
            }
            //---
            $db->table = "forum_comment";
            $db->condition = "`forum_id` = $post";
            $db->order = "";
            $db->limit = "";
            $rows = $db->select();
            foreach ($rows as $row) {
                if($row['user_id']>0) {
                    array_push($list_user, $row['user_id']);
                }
                if($row['modified_user']>0) {
                    array_push($list_user, $row['modified_user']);
                }
            }
        }
    } elseif($type=='examination') {
        array_push($list_user, $user);
        //---
        $db->table = "examination";
        $db->condition = "`examination_id` = $post";
        $db->order = "";
        $db->limit = 1;
        $rows = $db->select();
        if($db->RowCount>0) {
            foreach ($rows as $row) {
                $to_all = json_decode($row['to_all']);
            }
            $list_user = array_merge($list_user, $to_all);
        }
    }

    $list_user = array_keys(array_flip($list_user));
    foreach ($list_user as $value) {
        if($value>0) {
            $onoff = 0;
            $db->table = "core_user";
            $db->condition = "`user_id` = $value";
            $db->order = "";
            $db->limit = 1;
            $rows_onoff = $db->select();
            foreach($rows_onoff as $row_onoff) {
                $onoff = $row_onoff['b_notify3']+0;
            }

            if($onoff == 1) {
                if ($value == $user) {
                    $db->table = "notify_status";
                    $data = array(
                        'type' => 1,
                        'notify_id' => $notify_id,
                        'user_id' => $value,
                        'status' => 1,
                        'modified_time' => $current_time
                    );
                    $db->insert($data);
                } else {
                    $db->table = "notify_status";
                    $data = array(
                        'type' => 1,
                        'notify_id' => $notify_id,
                        'user_id' => $value,
                        'modified_time' => $current_time
                    );
                    $db->insert($data);
                }
            }
        }
    }

    // Notify admin
    $list_user = array();
    if($type=='product') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE '%product_list%'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='forum') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE '%forum_list%'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='user') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'core_user'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='examination') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'examination_list'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/article_menu') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'article_menu_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/article') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'article_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/gallery_menu') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'gallery_menu_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/gallery') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'gallery_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/product_menu') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'product_menu_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/product') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'product_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/courses') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'product_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/forum_menu') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'forum_menu_edit;" . $category . "'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/library') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'library_edit'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    } elseif($type=='active/examination') {
        $db->table = "core_privilege";
        $db->condition = "`privilege_slug` LIKE 'examination_edit'";
        $db->order = "";
        $db->limit = "";
        $rows = $db->select();
        foreach ($rows as $row) {
            $db->table = "core_user";
            $db->condition = "`role_id` = " . $row['role_id'];
            $db->order = "";
            $db->limit = "";
            $rows2 = $db->select();
            foreach ($rows2 as $row2) {
                if ($row2['user_id'] > 0) {
                    array_push($list_user, $row2['user_id']);
                }
            }
        }
    }

    $list_user = array_keys(array_flip($list_user));
    foreach ($list_user as $value) {
        if($value>0) {
            $onoff = 0;
            $db->table = "core_user";
            $db->condition = "`user_id` = $value";
            $db->order = "";
            $db->limit = 1;
            $rows_onoff = $db->select();
            foreach($rows_onoff as $row_onoff) {
                $onoff = $row_onoff['b_notify1']+0;
            }

            if($onoff == 1) {
                if ($value == $user) {
                    $db->table = "notify_status";
                    $data = array(
                        'notify_id' => $notify_id,
                        'user_id' => $value,
                        'status' => 1,
                        'modified_time' => $current_time
                    );
                    $db->insert($data);
                } else {
                    $db->table = "notify_status";
                    $data = array(
                        'notify_id' => $notify_id,
                        'user_id' => $value,
                        'modified_time' => $current_time
                    );
                    $db->insert($data);
                }
            }
        }
    }
    return true;
}

function updateNotify($type, $post, $user, $status = 1) {
	global $db;

	$notify = array();
	$db->table = "notify";
	$db->condition = "`type` LIKE '$type' AND `post` = $post";
	$db->order = "";
	$db->limit = "";
	$rows = $db->select();
	if($db->RowCount) {
		foreach($rows as $row) {
			array_push($notify, $row['notify_id']);
		}
		$notify = array_keys(array_flip($notify));
		$notify = implode(',', $notify);
		//---
		$db->table = "notify_status";
		$data = array(
				'status' => $status,
				'modified_time' => time()
		);
		$db->condition = "`type` = 0 AND `notify_id` IN ($notify) AND `user_id` = $user";
		$db->update($data);
	}

}

function infoItemNotify($key, $id, $stt = 0) {
	global $db, $tth_msg_notify;
	$result = $status = '';

	if($stt==0) $status = ' class="in-new"';
	else $status = '';

	$db->table = "notify";
	$db->condition = "`notify_id` = $id";
	$db->order = "`created_time` DESC";
	$db->limit = 1;
	$rows_ii = $db->select();
	if($db->RowCount>0) {
		foreach ($rows_ii as $row_ii) {
			if($row_ii['type']=='user') $nf_USER = getInfoUser($row_ii['post']);
			else $nf_USER = getInfoUser($row_ii['user_id']);

			$avatar     = '<div class="in-left">' . $nf_USER[4] . '</div>';

			$result .= '<li' . $status . ' rel="' . $key . '">';

			$link_s = $link_e = $item = '';
			if($row_ii['type']=='product') {
				$db->table = "product";
				$db->condition = "`product_id` = " . $row_ii['post'];
				$db->order = "";
				$db->limit = 1;
				$rows_it = $db->select();
				foreach($rows_it as $row_it) {
                    $link_s = '<a href="' . HOME_URL_LANG .'/?ol=discussion_list&id=' . $row_it['product_id'] . '" title="' . stripslashes($row_it['name']) . '">';
					$link_e = '</a>';
                    $item = ': <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
			} elseif($row_ii['type']=='forum') {
				$db->table = "forum";
				$db->condition = "`forum_id` = " . $row_ii['post'];
				$db->order = "";
				$db->limit = 1;
				$rows_it = $db->select();
				foreach($rows_it as $row_it) {
                    $link_s = '<a href="' . HOME_URL_LANG . '/?ol=forum_comment&id=' . $row_it['forum_id'] . '" title="' . stripslashes($row_it['name']) . '">';
                    $link_e = '</a>';
					$item = ': <strong>' . stripslashes($row_it['name']) . '</strong>';
				}
			} elseif($row_ii['type']=='user') {
				$db->table = "core_user";
				$db->condition = "`user_id` = " . $row_ii['post'];
				$db->order = "";
				$db->limit = 1;
				$rows_it = $db->select();
				foreach($rows_it as $row_it) {
                    $link_s = '<a href="' . HOME_URL_LANG . '/?ol=core_user_edit&id=' . $row_it['user_id'] . '" title="' . stripslashes($row_it['full_name']) . '">';
                    $link_e = '</a>';
				}
			} elseif($row_ii['type']=='examination') {
                $db->table = "examination";
                $db->condition = "`examination_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    $link_s = '<a href="' . HOME_URL_LANG . '/?ol=examination_list&id=' . $row_it['examination_id'] . '" title="' . stripslashes($row_it['title']) . '">';
                    $link_e = '</a>';
                    $item = ': <strong>' . stripslashes($row_it['title']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/article_menu') {
                $db->table = "article_menu";
                $db->condition = "`article_menu_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=article_menu_edit&id=' . intval($row_it['article_menu_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Chuyên mục mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/article') {
                $db->table = "article";
                $db->condition = "`article_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=article_edit&id=' . intval($row_it['article_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Bài viết mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/gallery_menu') {
                $db->table = "gallery_menu";
                $db->condition = "`gallery_menu_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=gallery_menu_edit&id=' . intval($row_it['gallery_menu_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Chuyên mục mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/gallery') {
                $db->table = "gallery";
                $db->condition = "`gallery_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=gallery_edit&id=' . intval($row_it['gallery_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Hình ảnh mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/product_menu') {
                $db->table = "product_menu";
                $db->condition = "`product_menu_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=product_menu_edit&id=' . intval($row_it['product_menu_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Chuyên mục mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/product') {
                $db->table = "product";
                $db->condition = "`product_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=product_edit&id=' . intval($row_it['product_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Khoá học mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/courses') {
                $db->table = "courses";
                $db->condition = "`courses_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=courses_edit&id=' . intval($row_it['courses_id']) . '" title="' . stripslashes($row_it['name']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Bài giảng mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/forum_menu') {
                $db->table = "forum_menu";
                $db->condition = "`forum_menu_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=forum_menu_edit&id=' . intval($row_it['forum_menu_id']) . '" title="' . stripslashes($row_it['title']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Chuyên mục mới: <strong>' . stripslashes($row_it['name']) . '</strong>';
                }
            } elseif($row_ii['type']=='active/library') {
                $db->table = "library";
                $db->condition = "`library_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=library_edit&id=' . intval($row_it['library_id']) . '" title="Câu hỏi">';
                        $link_e = '</a>';
                    }
                    $type = (intval($row_it["type"])==0) ? 'Trắc nghiệm' : 'Tự luận';
                    $item = ' Câu hỏi mới: <strong>' . $type . '</strong>';
                }
            } elseif($row_ii['type']=='active/examination') {
                $db->table = "examination";
                $db->condition = "`examination_id` = " . $row_ii['post'];
                $db->order = "";
                $db->limit = 1;
                $rows_it = $db->select();
                foreach($rows_it as $row_it) {
                    if($stt==0) {
                        $link_s = '<a href="' . HOME_URL_LANG . '/?ol=examination_edit&id=' . intval($row_it['examination_id']) . '" title="' . stripslashes($row_it['title']) . '">';
                        $link_e = '</a>';
                    }
                    $item = ' Bài kiểm tra: <strong>' . stripslashes($row_it['title']) . '</strong>';
                }
            }

			$result .= $link_s . $avatar . '<div class="in-right"><div class="in-line"><strong>' . $nf_USER[0] . '</strong> ' . $tth_msg_notify[$row_ii['msg']] . $item . '</div><div class="in-time"><span class="in-icon">' . convertTime5DayAgo($row_ii['created_time']) . '</span></div></div>' . $link_e;
			$result .= '</li>';
		}
	}

	return $result;
}

function getNameProductMenu($id) {
    global $db;
    $result = '';
    $db->table = "product_menu";
    $db->condition = "`product_menu_id` = " . intval($id);
    $db->order = "";
    $db->limit = 1;
    $rows = $db->select();
    if($db->RowCount>0) {
        foreach($rows as $row) {
            $result = stripslashes($row['name']);
        }
    } else $result = '(Không tồn tại)';

    return $result;
}