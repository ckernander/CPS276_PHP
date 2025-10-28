<?php
require_once __DIR__ . "/../classes/Pdo_methods.php";

$output = "";

$pdo = new PdoMethods();
$sql = "SELECT file_name, file_path FROM uploaded_files";
$records = $pdo->selectNotBinded($sql);

if ($records == "error" || empty($records)) {
    $output = "<p>No files have been uploaded yet.</p>";
} else {
    $output = "<ul class='list-group'>";
    foreach ($records as $row) {
        $name = htmlspecialchars($row["file_name"]);
        $path = htmlspecialchars($row["file_path"]);
        $output .= "<li><a target='_blank' href='$path'>$name</a></li>";
    }
    $output .= "</ul>";
}
?>