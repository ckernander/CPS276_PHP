<?php

function addAndSortNames() {
    // If clear was clicked, return empty string
    if (isset($_POST['clear'])) {
        return '';
    }

    $previousList = $_POST['nameListHidden'] ?? '';
    $namesArray = [];

    if (!empty($previousList)) {
        // Convert list to array
        $namesArray = explode("\n", trim($previousList));
    }

    $fullName = trim($_POST['nameInputBox'] ?? '');

    if ($fullName !== '') {
        $parts = explode(" ", $fullName);

        if (count($parts) === 2) {
            $first = ucfirst(strtolower($parts[0]));
            $last = ucfirst(strtolower($parts[1]));
            $formatted = "$last, $first";
            $namesArray[] = $formatted;
        } else {
            $namesArray[] = "Invalid Input: '$fullName'";
        }
    }

    sort($namesArray, SORT_STRING | SORT_FLAG_CASE);

    return implode("\n", $namesArray);
}