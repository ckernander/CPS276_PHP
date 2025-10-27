<?php
/*
1. The assignment specifies that "all PHP written at the top above the HTML Doctype".
Explain the implications of this placement on how the server processes the page. 
What advantage does generating all PHP variables ($evenNumbers, $form, $table) before any HTML output provide in terms of execution flow?
*/
$numbArray = range(1,50);
$evenNumbersLoop = [];
$evenNumbers = "";

/*
2. Beyond simply finding even numbers, describe a scenario where you would use a similar foreach loop with a conditional (if) 
statement to filter or process elements from an array based on different criteria like finding all numbers divisible by 7
*/
foreach ($numbArray as $numb){
    if($numb%2 == 0){
        $evenNumbersLoop[] = $numb;
    }
}

$evenNumbers ="Even Numbers: ". implode(" - ", $evenNumbersLoop);

/*
4. The createTable function uses nested for loops to build the table. Describe the role of each loop: which one is 
responsible for iterating through the rows, and which for the columns?
How does the concatenation (.=) inside these loops incrementally build the complete HTML table string?
*/
function createTable($rows, $columns){
    $table = "<table class='table table-bordered mt-4'>";
        for ($i = 1; $i <= $rows; $i++) {
            $table .= "<tr>";
            for ($j = 1; $j <= $columns; $j++) {
                $table .= "<td>Row{$i}, Col{$j}</td>";
        }
        $table .= "</tr>";
    }

    $table .= "</table>";
    return $table;
}
/*
3. Discuss the primary benefits of using heredoc for embedding large blocks of HTML or other text within PHP strings, especially when that text contains 
quotes or multiple lines. How does it improve code readability compared to concatenating strings with double quotes?
*/
$form = <<<HTML
<head>
    <meta charset="utf-8">
    <title>Form Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
    <form action="#" method="post" class="row g-3">
        <div class="col-12">
         <label for="email" class="form-label">Email Adress</label>
         <input type="text" id="email" name="email" class="form-control" placeholder="name@example.com">
        </div>
        <div class="col-12">
         <label for="textarea" class="form-label">Example Textarea</label>
         <textarea id="textarea" name="textarea" class="form-control"></textarea>
        </div>
        
    </form>

HTML;
?>
<!doctype html>
<body class="container">
    <?php
    
        echo $evenNumbers;
        echo $form;
        echo createTable(8, 6);
        
    ?>
</body>


</html>