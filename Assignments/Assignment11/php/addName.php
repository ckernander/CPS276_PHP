<?php
require_once("../classes/Pdo_methods.php");

$pdo = new PdoMethods();

$data = json_decode(file_get_contents("php://input"), true);

$response = new stdClass();

if (!isset($data["name"]) || trim($data["name"]) === "") {
    $response->masterstatus = "error";
    $response->msg = "You must enter a name.";
    echo json_encode($response);
    exit();
}

$full = trim($data["name"]);
$parts = explode(" ", $full);

if (count($parts) < 2) {
    $response->masterstatus = "error";
    $response->msg = "Enter first and last name.";
    echo json_encode($response);
    exit();
}

$fname = array_shift($parts);
$lname = implode(" ", $parts);

$sql = "INSERT INTO names (lname, fname) VALUES (:lname, :fname)";
$bindings = [
    [":lname", $lname, "str"],
    [":fname", $fname, "str"]
];

$result = $pdo->otherBinded($sql, $bindings);

if ($result === "noerror") {
    $response->masterstatus = "success";
    $response->msg = "Name added.";
} else {
    $response->masterstatus = "error";
    $response->msg = "Error adding name.";
}

echo json_encode($response);
?>