<?php
require_once "Calculator.php";

$Calculator = new Calculator();

$result="";
$result .= $Calculator->calc("*", 10, 2);
$result .= $Calculator->calc("*", 4.56, 2);
$result .= $Calculator->calc("/", 10, 2);
$result .= $Calculator->calc("/", 10, 3);
$result .= $Calculator->calc("/", 10, 0);
$result .= $Calculator->calc("/", 0, 10);
$result .= $Calculator->calc("-", 10, 2);
$result .= $Calculator->calc("-", 10, 20);
$result .= $Calculator->calc("+", 10.5, 2);
$result .= $Calculator->calc("+", 10.5, 0);
$result .= $Calculator->calc("*", 10);
$result .= $Calculator->calc("+","a",10);
$result .= $Calculator->calc("+",10,"a");
$result .= $Calculator->calc(10);
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <title>Basic Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<h1>Calculator Output</h1>
 <main>
 <?php echo $result ?>
 </main>
</html>