<?php
require_once __DIR__ . '/Classes/Directories.php';

$dir = new Directories();
$dir->handleRequest();
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>File and Directories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
<h1>File and Directory Assignment</h1>
<p>Enter a folder name and the contents of a file. Folder names should contain alphanumeric characters only.</p>

<?php if ($dir->link): ?>
    <p><a href="<?= htmlspecialchars($dir->link) ?>">Path where the file is located</a></p>
<?php endif; ?>

<?php if ($dir->message): ?>
    <p style="color: red;"><?= htmlspecialchars($dir->message) ?></p>
<?php endif; ?>

<form method="post">
    <label for="dirname">Directory Name:</label><br>
    <input type="text" name="dirname" id="dirname" value="<?= htmlspecialchars($dir->dirname) ?>" required><br><br>

    <label for="filecontent">File Content:</label><br>
    <textarea name="filecontent" id="filecontent" rows="10" cols="50" required><?= htmlspecialchars($dir->filecontent) ?></textarea><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>