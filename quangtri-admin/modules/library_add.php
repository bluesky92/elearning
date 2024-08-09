<?php
if (!defined('TTH_SYSTEM')) { die('Please stop!'); }
//
?>
<!-- Menu path -->
	<div class="row">
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo ADMIN_DIR?>"><i class="fa fa-home"></i> Trang chủ</a>
			</li>
			<li>
				<a href="?<?php echo TTH_PATH?>=library_list"><i class="fa fa-edit"></i> Quản lý nội dung</a>
			</li>
			<li>
				<a href="?<?php echo TTH_PATH?>=library_list"><i class="fa fa-book"></i> Thư viện đề thi</a>
			</li>
			<li>
				<i class="fa fa-plus-square-o"></i> Thêm câu hỏi
			</li>
		</ol>
	</div>
<!-- /.row -->
<?php
include_once (_A_TEMPLATES . DS . "library.php");
if(empty($typeFunc)) $typeFunc = "no";
$OK         = false;
$error      = '';
function bind_param_array($stmt, $params) {
    $types = "";
    $bind_params = array();

    foreach ($params as $param) {
        $bind_params[] = &$param; // Phải sử dụng tham chiếu &
        if (is_int($param)) {
            $types .= "i"; // Integer
        } elseif (is_float($param)) {
            $types .= "d"; // Double
        } elseif (is_string($param)) {
            $types .= "s"; // String
        } else {
            $types .= "b"; // Blob
        }
    }

    array_unshift($bind_params, $types);
    call_user_func_array(array($stmt, 'bind_param'), $bind_params);
}

if($typeFunc=='add'){
    $date           = new DateClass();
    $file_max_size  = FILE_MAX_SIZE;
    $u_file         = '-no-';
    $dir_dest       = ROOT_DIR . DS . "uploads" . DS . "library" . DS;
    $file_type      = $_FILES['file']['type'];
    $file_name      = $_FILES['file']['name'];
    $file_size      = $_FILES['file']['size'];
    $file_type      = trim(strrchr($file_name, '.'));
    $file_full_name = "tmp_" . time() . $file_type;

    if (($file_size > 0) && ($file_size <= $file_max_size)) {
        if ($file_type == ".xlsx" || $file_type == ".xls" || $file_type == ".docx" ) {

            if (@move_uploaded_file($_FILES['file']['tmp_name'], $dir_dest . $file_full_name)) {
                $u_file = 'Excel_' . time() . '_' . md5(uniqid()) . $file_type;
                @rename($dir_dest . $file_full_name, $dir_dest . $u_file);
                $OK = true;
            } else $OK = false;
        } else $OK = false;
    } else {
        $OK = false;
    }

    // Insert Database.
    if(!$OK) $error = '<span class="show-error">Vui lòng chèn file câu hỏi. Hiện tại chỉ hỗ trợ file định dạng .docx, .xls, .xlsx</span>';
    else {
		if ($file_type == ".xlsx" || $file_type == ".xls") {
			include(_F_CLASSES . DS . "PHPExcel" . DS . "IOFactory.php");
			$objPHPExcel = PHPExcel_IOFactory::load($dir_dest . $u_file);
			foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$highestRow = $worksheet->getHighestRow();
				$library_id = 0;
				for ($row = 2; $row <= $highestRow; $row++) {
					$content    = trim($worksheet->getCellByColumnAndRow(1, $row)->getValue());
					$type       = intval($worksheet->getCellByColumnAndRow(2, $row)->getValue());
					$title      = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
					$correct    = trim($worksheet->getCellByColumnAndRow(4, $row)->getValue());
					if(!empty($content)) {
						$is_active = isset($_POST['is_active']) ? intval($_POST['is_active']) : 0;
						//---
						$db->table = "library";
						$data = array(
							'product_menu_id' => intval($product_menu_id),
							'product_id' => intval($product_id),
							'type' => intval($type),
							'content' => $db->clearText($content),
							'is_active' => intval($is_active),
							'created_time' => time(),
							'modified_time' => time(),
							'user_id' => $_SESSION["user_id"]
						);
						$db->insert($data);
						$library_id = $db->LastInsertID;
						if($is_active==0) {
							// Ghi thông báo.
							insertNotify(15, 'active/library', $library_id, $_SESSION["user_id"]);
						}
					}

					if($type==1) {
						$db->table = "library_answer";
						$data = array(
							'library_id' => $library_id,
							'title' => $db->clearText($title),
							'correct_1' => $db->clearText($correct)
						);
						$db->insert($data);
					} elseif(empty($correct)) {;
						$db->table = "library_answer";
						$data = array(
							'library_id' => $library_id,
							'title' => $db->clearText($title)
						);
						$db->insert($data);
					} else {;
						$db->table = "library_answer";
						$data = array(
							'library_id' => $library_id,
							'title' => $db->clearText($title),
							'correct' => 1
						);
						$db->insert($data);
					}

				}
			}
			loadPageSucces("Đã thêm dữ liệu thành công.", "?".TTH_PATH."=library_list");
		}
        if ($file_type == ".docx") {
			$path = ROOT_DIR.DS."vendor".DS."autoload.php";
			$pathIO = ROOT_DIR.DS."vendor".DS."phpoffice".DS."phpword".DS."src".DS."PhpWord".DS."IOFactory.php";
			// Đường dẫn tới file Word
			//$wordFilePath = 'C:\xampp\htdocs\elearning\a.docx';
			require $path;
			include($pathIO);
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "elearning";
			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$phpWord = PhpOffice\PhpWord\IOFactory::load($dir_dest . $u_file);
			$questionPattern = '/^Câu\s+\d+:/'; // Mẫu regex để nhận diện câu hỏi
			$currentQuestionId = 0;
			foreach ($phpWord->getSections() as $section) {
				foreach ($section->getElements() as $element) {
					if (method_exists($element, 'getText')){
						$text = $element->getText();
						if (preg_match($questionPattern, $text)) {
							$questionText = trim(substr($text, strpos($text, ':') + 1));
							//echo("$questionText\n");
							//$stmt = $conn->prepare("INSERT INTO olala3w_library (product_menu_id,product_id,content,type,is_active,created_time,modified_time,user_id) VALUES (?,?,?,?,?,?,?,?)");
							//$stmt = $conn->prepare("INSERT INTO olala3w_library (product_menu_id,product_id,content,type) VALUES (?,?,?,?)");
							//if ($stmt === false) {
							//	die('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
							//}	
	//echo "$product_menu_id=";
	//echo "$product_id=";
	//echo $_SESSION["user_id"];
	//var_dump($stmt);
	//$stmt->bind_param("iisi", intval($product_menu_id),intval($product_id),$questionText,0);
			
				//echo "bind_param__";
							//$params = array($product_menu_id, $product_id, $questionText, 0);
							//bind_param_array($stmt, $params);				
							//$stmt->execute();
							//$currentQuestionId = $stmt->insert_id;
							//$stmt->close();
							/*$db->table = "questions";
							$data = array(
								'question_text' => $db->clearText($questionText)
							);
							$db->insert($data);
							$currentQuestionId = $db->LastInsertID;*/
							$db->table = "library";
							$data = array(
								'product_menu_id' => intval($product_menu_id),
								'product_id' => intval($product_id),
								'type' => intval($type),
								'content' => $db->clearText($questionText),
								'is_active' => intval($is_active),
								'created_time' => time(),
								'modified_time' => time(),
								'user_id' => $_SESSION["user_id"]
							);
							$db->insert($data);
							$currentQuestionId = $db->LastInsertID;
							if($is_active==0) {
								// Ghi thông báo.
								insertNotify(15, 'active/library', $library_id, $_SESSION["user_id"]);
							}
							//echo $currentQuestionId;
						}elseif ($currentQuestionId !== 0) {
							// Nếu không khớp với mẫu câu hỏi thì đây là đáp án
							if (stripos($text, 'Đáp án:') === false) {
								// Thêm đáp án vào cơ sở dữ liệu
								$answerText = trim($text);
								$isCorrect = false; 
								if(strpos($answerText, '-----')== false){
									echo ("answerText:[$answerText]");
									$db->table = "library_answer";
									$data = array(
										'library_id' => $currentQuestionId,
										'title' => $db->clearText($answerText),
										'correct' => 0
									);
									$db->insert($data);
								}
								//$buff_str = substr($answerText,strpos($answerText, '.')+1); 
								
								//echo ("answerText:$buff_str\n");
								/*
								$stmt = $conn->prepare("INSERT INTO olala3w_library_answer (library_id, title, correct) VALUES (?, ?, ?)");
								$stmt->bind_param("isi", $currentQuestionId, $answerText, $isCorrect);
								$stmt->execute();
								$stmt->close();
								*/
							} else {
								// Xử lý đáp án đúng
								$correctAnswer = trim(substr($text, strpos($text, ':') + 1));
								$correctAnswer = trim($correctAnswer, ' .');
								/*
								$db->table = "library_answer";
								$data = array(
									'correct' => 1
								);
								$db->condition = "`library_id` = $currentQuestionId AND LEFT(`title`, 1) = $correctAnswer";
								$db->update($data);
								//echo ("Đáp án: $correctAnswer\n");
								*/
								//*
								
								$stmt = $conn->prepare("UPDATE olala3w_library_answer SET correct = 1 WHERE library_id = ? AND LEFT(title, 1) = ?");
								$stmt->bind_param("is", $currentQuestionId, $correctAnswer);
								$stmt->execute();
								$stmt->close();  
							}
						}
						
					}
						
						
				}
				
			}
			
			//echo("OK");
			loadPageSucces("Đang dev tính năng này.", "?".TTH_PATH."=library_list");
		}

        

	}
}
else {
    $product_menu_id    = 0;
    $product_id         = 0;
	$content            = "";
    if(in_array("library_active", $corePrivilegeSlug)) $is_active = 1;
    else $is_active = 0;
}
if(!$OK) library("?".TTH_PATH."=library_add", "add", 0, $product_menu_id, $product_id, $is_active, $error);
// Định nghĩa hàm bind_param_array()
