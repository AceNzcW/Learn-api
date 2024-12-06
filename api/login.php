<?php
    include "./connect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    $datas = [];

    foreach($query as $i => $data){
        $datas[] = array(
            'username' => $data['username'],
            'password' => $data['password'],
            'role' => $data['role']
        );
    }

    if($datas === []){
        echo json_encode([
            'res' => '200',
            'data' => null,
            'massage' => 'Login failed',
            'status' => 'FAILED',
        ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit();
    }

    echo json_encode([
        'res' => '200',
        'data' => $datas,
        'massage' => 'Login success',
        'status' => 'SUCCED'
    ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>