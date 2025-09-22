<?php

$numbArray = range(1,50);
$evenNumbersLoop = [];
$evenNumbers = "";

foreach ($numbArray as $numb){
    if($numb%2 == 0){
        $evenNumbersLoop[] = $numb;
    }
}

$evenNumbers ="Even Numbers: ". implode(" - ", $evenNumbersLoop);

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