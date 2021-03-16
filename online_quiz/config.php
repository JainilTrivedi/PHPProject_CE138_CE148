<?php
try {
    $database = new PDO('mysql:host=localhost;dbname=online_quiz', 'root', '');
    //echo "Connection Established...<br/>";
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
// echo "Done";
