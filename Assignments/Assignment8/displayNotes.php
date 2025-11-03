<?php
require_once __DIR__ . '/classes/Date_Time.php';

$dateTimeObj = new Date_Time();
$output = '';
$notesTable = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $result = $dateTimeObj->getNotesByDateRange($_POST);
    $output = $result['output'];
    $notesTable = $result['notesTable'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title mb-4">Display Notes by Date Range</h3>
            <div class="mb-3">
                <a href="index.php" class="text-decoration-none">Add Notes</a>
            </div>
            
            <?= $output ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="begDate" name="begDate">
                           value="<?= htmlspecialchars($_POST['begDate'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                           value="<?= htmlspecialchars($_POST['endDate'] ?? '') ?>">
                </div>

                <button type="submit" class="btn btn-primary">Get Notes</button>
            </form>

            <?= $notesTable ?>
        </div>
    </div>
</div>

</body>
</html>