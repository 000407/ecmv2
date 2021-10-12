<?php

function get_products()
{
    $mysqli = new mysqli('localhost', 'root', '', 'db_ecm', 3306);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sql = "SELECT id, item_title, item_subtitle FROM products;";

    # create a prepared statement
    $stmt = $mysqli->prepare($sql);

    $rows = execute_and_extract_result($stmt);

    # Closure
    $stmt->close();
    $mysqli->close();

    return $rows;
}

function get_product($id)
{
    $mysqli = new mysqli('localhost', 'root', '', 'db_ecm', 3306);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    $sql = "SELECT id, item_title, item_subtitle FROM products WHERE id=?;";

    # create a prepared statement
    $stmt = $mysqli->prepare($sql);

    # Bind query parameters
    $stmt->bind_param('s', $id);

    $rows = execute_and_extract_result($stmt);

    # Closure
    $stmt->close();
    $mysqli->close();

    return $rows[0] ?? null;
}

function execute_and_extract_result($stmt) {
    # execute query
    $stmt->execute();

    # Get the result object
    $res = $stmt->get_result();

    $rows = array();

    # Fetching each record into the memory as an associative array
    while($rec = $res->fetch_assoc()) {
        $rows[] = $rec;
    }

    return $rows;
}
