<?php

require_once 'php/fileUploadProc.php';

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
    <h1>File Upload</h1>
    <?php echo $output?>
    <form method="POST" action="" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label for="filename" class="form-label">Enter File Name</label>
            <input type="text" name="filename" id="filename" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Select File</label>
            <input type="file" name="file" id="file" class="form-control" accept="application/pdf" required>
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="listFiles.php" class="btn btn-secondary ms-2">View Uploaded Files</a>
    </form>
</body>
</html>