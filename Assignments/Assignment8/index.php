<?php

require_once __Dir__ . '/classes/Date_Time.php';

$dateTimeObj = new Date_Time();
$output = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $output = $dateTimeObj->processForm($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Date and Time</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">Enter Date, Time, and Notes</h3>

            <form method="POST">
                <div class="mb-3">
                    <a href="displayNotes.php" class="text-decoration-none"> View Saved Notes </a>
                </div>
                <div class="mb-3">
                    <label for="dateTime" class="form-label">Select Date and Time</label>
                    <input type="datetime-local" class="form-control" id="dateTime" name="dateTime" required>
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Type your notes here..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
