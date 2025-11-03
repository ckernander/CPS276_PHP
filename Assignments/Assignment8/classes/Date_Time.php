<?php

require_once __Dir__ . '/Pdo_methods.php';

class Date_Time {

    public function processForm($postData) {
    $datetime = trim($postData['dateTime'] ?? '');
    $notes = trim($postData['notes'] ?? '');
    $output = '';

        if (empty($datetime) || empty($notes)) {
            return '<div class="alert alert-danger">Please enter both a date/time and a note.</div>';
        }

        $timestamp = strtotime($datetime);
        if ($timestamp === false) {
            return '<div class="alert alert-danger">Invalid date/time format.</div>';
        }

        $pdo = new PdoMethods();
        $query = "INSERT INTO notes (date_time, note_text) VALUES (:date_time, :note)";
        $params = [
            ':date_time' => $timestamp,
            ':note' => $notes
        ];

        $result = $pdo->otherBinded($query, [[':date_time', $timestamp, 'int'],[':note', $notes, 'str']]);

        if ($result === 'noerror') {
            $output = '<div class="alert alert-success">Your note has been saved successfully!</div>';
        } else {
            $output = '<div class="alert alert-danger">Error saving note.</div>';
        }


        return $output;
    }

    public function getNotesByDateRange($postData) {
    $startDate = trim($postData['begDate'] ?? '');
    $endDate = trim($postData['endDate'] ?? '');
    $output = '';
    $notesTable = '';

        if (empty($startDate) || empty($endDate)) {
            $output = '<div class="alert alert-danger">No notes found for the date range selected.</div>';
            return ['output' => $output, 'notesTable' => $notesTable];
        }

    $startTimestamp = strtotime($startDate);
    $endTimestamp = strtotime($endDate . ' 23:59:59');

    $pdo = new PdoMethods();

    $query = "SELECT date_time, note_text FROM notes WHERE date_time BETWEEN :start AND :end ORDER BY date_time DESC";

    $bindings = [[':start', $startTimestamp, 'int'],[':end', $endTimestamp, 'int']];

    $results = $pdo->selectBinded($query, $bindings);

    if ($results && count($results) > 0) {
        $notesTable = '<table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Date/Time</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($results as $row) {
            $notesTable .= '<tr>';
            $notesTable .= '<td>' . date('Y-m-d H:i', $row['date_time']) . '</td>';
            $notesTable .= '<td>' . htmlspecialchars($row['note_text']) . '</td>';
            $notesTable .= '</tr>';
        }
        $notesTable .= '</tbody></table>';
        } else {
            $output = '<div class="alert alert-danger">Unable to find notes for the date range selected.</div>';
        }

        return ['output' => $output, 'notesTable' => $notesTable];
    }
}
?>