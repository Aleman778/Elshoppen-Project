<?php

    $connection = false;
    $insert_success = array();
    $insert_failed = array();

    function loadFile($file) {
        $contents = "";
        if ($fh = fopen($file, "r")) {
            while (!feof($fh)) {
                $contents .= fgets($fh);
            }
            fclose($fh);
        }
        return $contents;
    }

    function createTable($conn, $table) {
        $sql = loadFile("../sql/$table.sql");
        if ($conn->query($sql)) {
            array_push($insert_success, $table);
        } else {
            array_push($insert_failed, $table);
        }
    }

    //taken from https://css-tricks.com/snippets/php/generate-csv-from-array/
    function generateCsv($data, $delimiter = ',', $enclosure = '"') {
        $handle = fopen('php://temp', 'r+');
        foreach ($data as $line) {
                fputcsv($handle, $line, $delimiter, $enclosure);
        }
        rewind($handle);
        while (!feof($handle)) {
                $contents .= fread($handle, 8192);
        }
        fclose($handle);
        return $contents;
    }

    //Create connection
    try {
        $dbhost = $_POST["dbhost"];
        $dbuser = $_POST["dbuser"];
        $dbpass = $_POST["dbpass"];
        $dbname = $_POST["dbname"];

        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        if (array_key_exists("createCart", $_POST)) {
            createTable($conn, "cart");
        }


        $ins_suc = generateCsv($insert_failed);
        $ins_err = generateCsv($insert_failed);
        header("Location: result.php?ins_suc=$ins_suc&ins_err=$ins_err");

    } catch(PDOException $e) {
        $err = "dbconn";
        if ($connection) {
            $err = "other";
        }
        header("Location: index.php?err=dbconn&msg=" . $e->getMessage());
    }

?>