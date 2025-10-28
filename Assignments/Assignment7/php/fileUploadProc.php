<?php
require_once __DIR__ . "/../classes/Pdo_methods.php";

$output = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["filename"])) {
        $output = "<p class='text-danger'>Error: You must enter a file name.</p>";
    } elseif (!isset($_FILES["file"]) || $_FILES["file"]["error"] != UPLOAD_ERR_OK) {
        $output = "<p class='text-danger'>Error: There was a problem uploading the file.</p>";
    } elseif ($_FILES["file"]["size"] > 100000) {
        $output = "<p class='text-danger'>Error: File size must be under 100KB.</p>";
    } else {
        // Validate MIME type
        $fileType = mime_content_type($_FILES["file"]["tmp_name"]);
        if ($fileType != "application/pdf") {
            $output = "<p class='text-danger'>Error: Only PDF files are allowed.</p>";
        } else {
            $filename = trim($_POST["filename"]);
            $uploadDir = "/home/c/k/ckernander/public_html/cps276/Assignments/Assignment7/files/";
            $newFileName = $filename . ".pdf";
            $uploadPath = $uploadDir . $newFileName;

            // Move uploaded file
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
                $pdo = new PdoMethods();

                $sql = "INSERT INTO uploaded_files (file_name, file_path) VALUES (:file_name, :file_path)";
                $bindings = [
                    [":file_name", $filename, "str"],
                    [":file_path", "files/" . $newFileName, "str"] // store relative path for easier linking
                ];

                $result = $pdo->otherBinded($sql, $bindings);

                if ($result == "noerror") {
                    $output = "<p class='text-success'>✅ File uploaded and saved successfully.</p>";
                } else {
                    $output = "<p class='text-danger'>❌ Database error occurred.</p>";
                }
            } else {
                $output = "<p class='text-danger'>❌ Failed to move uploaded file.</p>";
            }
        }
    }
}
?>
