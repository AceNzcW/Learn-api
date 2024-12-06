<?php
    include("./connect.php");

    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");

    if($check->num_rows > 0){
        echo json_encode(
            [
                'res' => '400',
                'massage' => 'Failed to Register',
                'status' => 'FAILED'
            ]
        );
        exit();
    }

    $query = $conn->query("INSERT INTO users(username, password, role) VALUES('$username', '$password', '$role')");

    if($query){
        echo json_encode(
            [
                'res' => '200',
                'massage' => 'Registered successfully chuy',
                'status' => 'SUCCEED'
            ]
        );
    }
?>