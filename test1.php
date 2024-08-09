<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "questions_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Đường dẫn tới file Word
$filePath = 'C:\xampp\htdocs\elearning\a.docx';

// Đọc file Word
$phpWord = IOFactory::load($filePath, 'Word2007');
$texts = [];

// Duyệt qua các phần của tài liệu
foreach ($phpWord->getSections() as $section) {
    foreach ($section->getElements() as $element) {
        if (method_exists($element, 'getText')) {
            $texts[] = $element->getText();
        }
    }
}

$question = '';
$answer = '';
$insideQuestion = false;

foreach ($texts as $text) {
    if (strpos($text, 'Câu') !== false) {
        if ($insideQuestion) {
            // Ghi câu hỏi và đáp án vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
            $stmt->bind_param("ss", $question, $answer);
            $stmt->execute();
            $stmt->close();
        }
        $question = trim(substr($text, strpos($text, ':') + 1));
        $answer = '';
        $insideQuestion = true;
    } else {
        if ($insideQuestion) {
            $answer .= ' ' . $text;
        }
    }
}

// Ghi câu hỏi cuối cùng và đáp án vào cơ sở dữ liệu nếu có
if ($insideQuestion) {
    $stmt = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");
    $stmt->bind_param("ss", $question, $answer);
    $stmt->execute();
    $stmt->close();
}

$conn->close();

echo "Data imported successfully!";
?>
