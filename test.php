<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

// Kết nối tới cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "root"; // tên người dùng MySQL của bạn
$password = ""; // mật khẩu MySQL của bạn
$dbname = "exam_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Đường dẫn tới file Word
$filePath = 'C:\xampp\htdocs\elearning\a.docx';

// Đọc file Word
$phpWord = IOFactory::load($filePath, 'Word2007');
$sections = $phpWord->getSections();

$currentQuestion = "";

foreach ($sections as $section) {
    $elements = $section->getElements();
    foreach ($elements as $element) {
        if (method_exists($element, 'getText')) {
            $text = trim($element->getText());

            if (substr($text, -1) === '?') { // Nếu kết thúc bằng dấu hỏi
                $currentQuestion = $text;
				echo($currentQuestion."\n");
                // Chèn câu hỏi vào bảng questions
				/*
                $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
                $stmt->bind_param("s", $currentQuestion);
                $stmt->execute();
                $questionId = $stmt->insert_id;
				
                $stmt->close();
				*/
            } else if (!empty($currentQuestion)) {
                // Chèn câu trả lời vào bảng answers
				/*
                $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text) VALUES (?, ?)");
                $stmt->bind_param("ii", $questionId, $text);
                $stmt->execute();
                $stmt->close();
				*/
            }
        }
    }
}

$conn->close();
/**/
echo "Import completed successfully!";
?>
