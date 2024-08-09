<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Load the Word file
$wordFilePath = 'C:\xampp\htdocs\elearning\a.docx';
$phpWord = IOFactory::load($wordFilePath,'Word2007');

// Read paragraphs from Word file
$sections = $phpWord->getSections();
foreach ($sections as $section) {
    $elements = $section->getElements();
    foreach ($elements as $element) {
        if (method_exists($element, 'getText')) {
            $text = $element->getText();
            if (strpos($text, 'Câu') !== false) {
                // This is a question
				
                //$questionText = trim(str_replace('Câu', '', $text));
                $questionText = substr($text, strpos($text, 'Câu')+1);
				if(strpos($questionText, ':')){
					$buff_str = substr($questionText,strpos($questionText, ':')+1);
					//echo ($buff_str);
				
                 /*
                // Insert question into database
                $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
                $stmt->bind_param("s", $buff_str);
                $stmt->execute();
                $questionId = $stmt->insert_id;
				*/
				}
				
                // Assuming the next paragraphs are answers
                for ($i = 1; $i <= 4; $i++) {
                    $nextElement = next($elements);
                    if (method_exists($nextElement, 'getText')) {
                        $answerText = $nextElement->getText();
                        $isCorrect = false;
						echo($answerText);
						echo ("-----------------------------\n");
                        if (strpos($answerText, '(đúng)') !== false) {
                            $isCorrect = true;
                            $answerText = str_replace('(đúng)', '', $answerText);
							//echo($answerText);
                        }
						/*
                        // Insert answer into database
                        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                        $stmt->bind_param("isi", $questionId, $answerText, $isCorrect);
                        $stmt->execute();
						*/
                    }
                }
            }
        }
    }
}

//$stmt->close();
//$conn->close();
