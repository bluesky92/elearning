<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertQuestion($conn, $questionText) {
    $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
    $stmt->bind_param("s", $questionText);
    $stmt->execute();
    $questionId = $stmt->insert_id;
    $stmt->close();
    return $questionId;
}

function insertAnswer($conn, $questionId, $answerText, $isCorrect) {
    $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $questionId, $answerText, $isCorrect);
    $stmt->execute();
    $stmt->close();
}

// Đường dẫn tới file Word
$wordFilePath = 'C:\xampp\htdocs\elearning\a.docx';

$phpWord = IOFactory::load($wordFilePath, 'Word2007');

$section = $phpWord->getSections();
foreach ($section as $section) {
    $elements = $section->getElements();
    $currentQuestion = '';
    $answers = [];
    $correctAnswer = '';

    foreach ($elements as $element) {
        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
            foreach ($element->getElements() as $e) {
                $text = $e->getText();

                if (preg_match('/^Câu \d+:/', $text)) {
                    // Lưu câu hỏi trước đó nếu có
                    if (!empty($currentQuestion)) {
                        $questionId = insertQuestion($conn, $currentQuestion);
                        foreach ($answers as $answer) {
                            insertAnswer($conn, $questionId, $answer['text'], $answer['is_correct']);
                        }
                        $answers = [];
                    }
                    $currentQuestion = trim(substr($text, strpos($text, ':') + 1));
                } elseif (preg_match('/^Đáp án:/', $text)) {
                    $correctAnswer = trim(substr($text, strpos($text, ':') + 1));
                } elseif (preg_match('/^[A-Z]\./', $text)) {
                    $answerText = trim(substr($text, 2));
                    $isCorrect = ($answerText == $correctAnswer) ? 1 : 0;
                    $answers[] = ['text' => $answerText, 'is_correct' => $isCorrect];
                }
            }
        }
    }

    // Lưu câu hỏi cuối cùng
    if (!empty($currentQuestion)) {
        $questionId = insertQuestion($conn, $currentQuestion);
        foreach ($answers as $answer) {
            insertAnswer($conn, $questionId, $answer['text'], $answer['is_correct']);
        }
    }
}

$conn->close();
?>
