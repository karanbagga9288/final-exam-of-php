<?php
    $dsn = 'mysql:host=172.31.22.43;dbname=entry';
    $username = 'Karan200449124';
    $password = 'KrMt3L5k-y';
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception..
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
