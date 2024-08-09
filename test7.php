
<?php
$zip = new ZipArchive;
$docFilePath = 'C:\xampp\htdocs\elearning\a.doc';

if ($zip->open($docFilePath) === TRUE) {
    $content = $zip->getFromName('word/document.xml');
    $zip->close();

    // Xử lý nội dung đã lấy được từ tệp tin .doc
} else {
    echo 'Failed to open the .doc file';
}
?>