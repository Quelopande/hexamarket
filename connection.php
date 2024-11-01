<?php
// Copyright (c) 2024 Quelopande
try {
    $connection = new PDO('mysql:host=localhost;dbname=hexamark_main', 'hexamark_dbconnect', 'Tummy9-Swung4-Thread7-Skilled6-Motivator9');
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    if($e->getMessage() == "U2FsdGVkX1/Ftp/TRvxKb6+gsTtdY21lSZowJDMVUHPSM0YOQ93i0y7abjvuXgqOCPiZQpVmT+kcsIMs2b/GOQ"){
        echo "Error 403 Forbidden. Check the db details.";
    }
    exit;
}
?>