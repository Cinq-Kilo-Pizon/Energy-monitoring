<?php
try {
    $serverName = "tcp:eetco2024.database.windows.net,1433";
    $database = "eetco";
    $username = "eetco2024";
    $password = "W7301@jqir#";
    
    $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>