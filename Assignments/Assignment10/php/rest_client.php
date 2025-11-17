<?php

function getWeather() {

    $zip = $_POST["zip_code"] ?? "";

    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code=" . urlencode($zip);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) {
        return [
            "<p class='error'>There was an error retrieving the records.</p>",
            ""
        ];
    }

    $data = json_decode($response, true);

    if ($data === null) {
        return [
            "<p class='error'>There was an error retrieving the records.</p>",
            ""
        ];
    }

    if (isset($data["error"])) {

        $errorText = htmlspecialchars($data["error"]);

        return [
            "<p class='error'>{$errorText}</p>",
            ""
        ];
    }

    $city = $data["searched_city"];

    $ack = "<p class='success'>Weather data for <strong>{$city["name"]}</strong> retrieved successfully.</p>";

    $output = "";

    $output .= "<h3>{$city["name"]}</h3>";
    $output .= "<p>Temperature: {$city["temperature"]}</p>";
    $output .= "<p>Humidity: {$city["humidity"]}</p>";

    $output .= "<h4>3-Day Forecast</h4>";
    $output .= "<ul>";

    foreach ($city["forecast"] as $day) {
        $output .= "<li><strong>{$day['day']}:</strong> {$day['condition']}</li>";
    }

    $output .= "</ul>";

    $higher = $data["higher_temperatures"];

    $output .= "<h4>Cities With Higher Temperatures</h4>";

    if (count($higher) === 0) {
        $output .= "<p>No cities found with higher temperatures.</p>";
    } else {
        $output .= "<table border='1' cellpadding='6'>";
        $output .= "<tr><th>City</th><th>Temperature</th></tr>";

        foreach ($higher as $h) {
            $output .= "<tr><td>{$h['name']}</td><td>{$h['temperature']}</td></tr>";
        }

        $output .= "</table>";
    }

    $lower = $data["lower_temperatures"];

    $output .= "<h4>Cities With Lower Temperatures</h4>";

    if (count($lower) === 0) {
        $output .= "<p>No cities found with lower temperatures.</p>";
    } else {
        $output .= "<table border='1' cellpadding='6'>";
        $output .= "<tr><th>City</th><th>Temperature</th></tr>";

        foreach ($lower as $l) {
            $output .= "<tr><td>{$l['name']}</td><td>{$l['temperature']}</td></tr>";
        }

        $output .= "</table>";
    }

    return [$ack, $output];
}
