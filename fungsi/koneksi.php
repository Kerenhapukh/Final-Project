<?php

$db = mysqli_connect('localhost', 'root', '', 'perpus');
if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

function query($query)
{
    global $db;
    
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}