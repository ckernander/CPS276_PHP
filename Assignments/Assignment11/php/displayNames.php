<?php
require_once("../classes/Pdo_methods.php");

$pdo = new PdoMethods();

$sql = "SELECT fname, lname FROM names ORDER BY lname ASC, fname ASC";
$records = $pdo->selectNotBinded($sql);

$response = new stdClass();

if ($records === "error") {
    $response->masterstatus = "error";
    $response->msg = "Could not retrieve names.";
    echo json_encode($response);
    exit();
}

$html = "<ul class='list-group'>";
foreach ($records as $row) {
    $html .= "<li class='list-group-item'>" .
             htmlspecialchars($row['lname'] . ", " . $row['fname']) .
             "</li>";
}
$html .= "</ul>";

$response->masterstatus = "success";
$response->names = $html;

echo json_encode($response);
?>