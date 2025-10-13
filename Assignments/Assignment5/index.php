<?php

require_once __DIR__ . '/Classes/Directories.php';

$message = '';
$link = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dirname = $_POST['dirname'] ?? '';
    $filecontent = $_POST['filecontent'] ?? '';

    $dir = new Directories();
    $result = $dir->createDirectoryWithFile($dirname, $filecontent);

    if ($result['success']) {
        $link = '?view=' . urlencode($dirname);
    } else {
        $message = $result['message'];
    }
}

// Handle viewing of readme.txt
if (isset($_GET['view'])) {
    $viewDir = $_GET['view'];
    if (preg_match('/^[A-Za-z]+$/', $viewDir)) {
        $filepath = __DIR__ . '/Directories/' . $viewDir . '/readme.txt';
        if (file_exists($filepath)) {
            header('Content-Type: text/plain');
            readfile($filepath);
            exit;
        }
    }
    echo "Invalid file path.";
    exit;
}

?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>File and Directories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
<h1>File and Directory Assignment</h1>
<p>Enter a folder name and the contents of a file. Folder names should contain alpha numaric characters only.</p>
<?php if ($link): ?>
    <p><a href="<?= htmlspecialchars($link) ?>">Path where the file is located</a></p>
<?php endif; ?>

<?php if ($message): ?>
    <p style="color: red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">
    <label for="dirname">Directory Name:</label><br>
    <input type="text" name="dirname" id="dirname" required><br><br>

    <label for="filecontent">File Content:</label><br>
    <textarea name="filecontent" id="filecontent" rows="10" cols="50" required></textarea><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>