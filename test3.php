<?php
require 'vendor/autoload.php';

//use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_db";

// Kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Đường dẫn tới file Word
$wordFilePath = 'C:\xampp\htdocs\elearning\CAU HOI CĐ 6 da tham dinh.docx';

$phpWord = \PhpOffice\PhpWord\IOFactory::load($wordFilePath);

$questionPattern = '/^Câu\s+\d+:/'; // Mẫu regex để nhận diện câu hỏi
$currentQuestionId = null;

foreach ($phpWord->getSections() as $section) {
    foreach ($section->getElements() as $element) {
        if (method_exists($element, 'getText')) {
            $text = $element->getText();

            if (preg_match($questionPattern, $text)) {
                // Nếu khớp với mẫu câu hỏi
                $questionText = trim(substr($text, strpos($text, ':') + 1));
				echo ($questionText."\n");
/*
                $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
                $stmt->bind_param("s", $questionText);
                $stmt->execute();
                $currentQuestionId = $stmt->insert_id;
                $stmt->close();
				*/
				$currentQuestionId = 10;
            } elseif ($currentQuestionId !== null) {
                // Nếu không khớp với mẫu câu hỏi thì đây là đáp án
                if (stripos($text, 'Đáp án:') === false) {
                    // Thêm đáp án vào cơ sở dữ liệu
                    $answerText = trim($text);
					$pos = strpos($text, '-----');
					if($pos == false) 
					//echo ("answerText:$text = [$pos]\n");
					//$buff_str = substr($answerText,strpos($answerText, '.')+1);
					
                    $isCorrect = false;
					/*
                    $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                    $stmt->bind_param("isi", $currentQuestionId, $answerText, $isCorrect);
                    $stmt->execute();
                    $stmt->close();
					 */
                } else {
                    // Xử lý đáp án đúng
                    $correctAnswer = trim(substr($text, strpos($text, ':') + 1));
                    $correctAnswer = trim($correctAnswer, ' .');
					echo ("Đáp án: $correctAnswer\n");
/*
                    $stmt = $conn->prepare("UPDATE answers SET is_correct = 1 WHERE question_id = ? AND LEFT(answer_text, 1) = ?");
                    $stmt->bind_param("is", $currentQuestionId, $correctAnswer);
                    $stmt->execute();
                    $stmt->close();
					 */
                }
            }
        }
    }
}

//$conn->close();
//echo "Data has been inserted successfully!";
?>
