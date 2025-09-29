<?php
$output = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 require_once 'processNames.php';
 $output = addAndSortNames();
}
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Add Names</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="Container">
    <h1>Add Names</h1>
     <form action="index.php" method="post">
        <button type="submit" class="btn btn-primary mt-3">Add Name</button>
        <button type="submit" name="clear" value="1" class="btn btn-danger mt-3">Clear List</button><br></br>

        <lable for="nameInputBox">Enter Name</lable>
        <input type="text" id="nameInputBox" name="nameInputBox" class="form-control">
        <input type="hidden" name="nameListHidden" value="<?php echo htmlspecialchars($output); ?>">
        <lable for="namelist">List of Names</lable>
        <textarea style="height: 500px;" class="form-control"
        id="namelist" name="namelist"><?php echo $output ?></textarea>
    </form>
</body>
</html>