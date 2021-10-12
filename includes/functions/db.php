<?php

function get_db_instance($no_db=false): mysqli
{
    $host = 'host';
    $port = '3306';
    $db_user = 'root';
    $db_pass = 'toor';
    $db_name = 'non_existent_db';
    extract(config('db'), EXTR_OVERWRITE);

    $db_name = $no_db ? null : $db_name;

    $mysqli = new mysqli($host, $db_user, $db_pass, $db_name, $port);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    return $mysqli;
}
