<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "arkara_bhayana";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    define("UPLOAD_DIR", __DIR__ . "/uploads/");
    define("MAX_FILE_SIZE", 100 * 1024 * 1024);
    define("ALLOWED_EXTENSIONS", ['jpg', 'jpeg', 'png', 'gif']);

    $users = $conn->query("SELECT * FROM users");
    $games = $conn->query("SELECT * FROM games");
    $list_games = $conn->query("SELECT * FROM games");
    $characters = $conn->query("SELECT * FROM characters");
    $weapons = $conn->query("SELECT * FROM weapons");
    $artifacts = $conn->query("SELECT * FROM artifacts");
    $elements = $conn->query("SELECT * FROM elements");
    $resonansis = $conn->query("SELECT * FROM resonansis");

    global $conn;
?>