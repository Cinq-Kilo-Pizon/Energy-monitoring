<?php
include_once "connection1.php";


    $query_volt = "SELECT voltage, time_ FROM PZEM"; // Correct variable name and query

    // Execute the query
    $stmt = $conn->query($query_volt);

    // Check if the query was successful
    if ($stmt) {
        // Process the result set
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Do something with each row
            print_r($row);
        }
    } else {
        echo "Query failed";
    }

?>
