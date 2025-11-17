<?php
$output = "";
$acknowledgement = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'php/rest_client.php';
    $result = getWeather();
    $acknowledgement = $result[0];
    $output = $result[1];

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Weather Lookup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <style>
        table { border-collapse: collapse; margin: 15px 0; }
        table, th, td { border: 1px solid black; padding: 6px; }
        .error { color: red; font-weight: bold; }
        .success { font-weight: bold; }
    </style>
    
</head>
<body class="container mt-4">

    <h2>Weather Lookup</h2>

    <?php echo $acknowledgement; ?>

    <form method="POST" class="mb-4">
        <label for="zip_code" class="form-label">Enter ZIP Code:</label>
        <input type="text" name="zip_code" id="zip_code" class="form-control" style="width:200px;">
        <button type="submit" class="btn btn-primary mt-2">Search</button>
    </form>

    <div id="weather-output">

        <?php echo $output; ?>

    </div>

</body>
</html>