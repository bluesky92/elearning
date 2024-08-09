<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
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
$wordFilePath = 'C:\xampp\htdocs\elearning\a.docx';

$phpWord = IOFactory::load($wordFilePath);

$questionPattern = '/^Câu\s+\d+:/'; // Mẫu regex để nhận diện câu hỏi
$currentQuestionId = null;
function insertQuestion($conn, $questionText) {
    $query = "INSERT INTO questions (question_text) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $questionText);
    echo sprintf($query, $questionText) . "\n"; // Hiển thị câu truy vấn
    $stmt->execute();
    $questionId = $stmt->insert_id;
    $stmt->close();
    return $questionId;
}
foreach ($phpWord->getSections() as $section) {
    foreach ($section->getElements() as $element) {
        if (method_exists($element, 'getText')) {
            $text = $element->getText();

            if (preg_match($questionPattern, $text)) {
                // Nếu khớp với mẫu câu hỏi
                $questionText = trim(substr($text, strpos($text, ':') + 1));
				//echo ($questionText."\n");
			
				$query = "INSERT INTO questions (question_text) VALUES (?)";
                //$stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $questionText);
				echo sprintf($query, $questionText) . "\n"; // Hiển thị câu truy vấn
                $stmt->execute();
                $currentQuestionId = $stmt->insert_id;
                $stmt->close();
				//*/
            } elseif ($currentQuestionId !== null) {
                // Nếu không khớp với mẫu câu hỏi thì đây là đáp án
                if (stripos($text, 'Đáp án:') === false) {
                    // Thêm đáp án vào cơ sở dữ liệu
                    $answerText = trim($text);
					if(strpos($answerText, '.'))
					$buff_str = substr($answerText,strpos($answerText, '.')+1);
					echo ("answerText:$buff_str\n");
                    $isCorrect = false;
                    $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                    $stmt->bind_param("isi", $currentQuestionId, $answerText, $isCorrect);
                    $stmt->execute();
                    $stmt->close();
					 
                } else {
                    // Xử lý đáp án đúng
                    $correctAnswer = trim(substr($text, strpos($text, ':') + 1));
                    $correctAnswer = trim($correctAnswer, ' .');
					echo ("Đáp án: $correctAnswer\n");
 
                    $stmt = $conn->prepare("UPDATE answers SET is_correct = 1 WHERE question_id = ? AND LEFT(answer_text, 1) = ?");
                    $stmt->bind_param("is", $currentQuestionId, $correctAnswer);
                    $stmt->execute();
                    $stmt->close();
					 
                }
            }
        }
    }
}

$conn->close();
echo "Data has been inserted successfully!";
?>
