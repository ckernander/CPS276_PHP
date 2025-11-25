<?php
require_once("../classes/Pdo_methods.php");

$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names";
$result = $pdo->otherNotBinded($sql);

$response = new stdClass();

if ($result === "noerror") {
    $response->masterstatus = "success";
    $response->msg = "All names cleared.";
} else {
    $response->masterstatus = "error";
    $response->msg = "Could not clear names.";
}

echo json_encode($response);
?>