<?php
    include "./connect.php";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $query = $conn->query("SELECT * FROM categories");

        $datas = [];

        foreach($query as $i => $data){
            $datas[] = array(
                'name' => $data['name'],
            );
        }

        if($datas !== []){
            echo json_encode([
                'res' => '200',
                'data' => $datas,
                'status' => 'SUCCEED'
            ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            exit();
        }

        echo json_encode([
            'res' => '200',
            'massage' => 'No Data'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];

        $check = $conn->query("SELECT * FROM categories WHERE name='$name'");

        if($check->num_rows > 0){
            echo json_encode([
                    'res' => '400',
                    'massage' => 'Category alredy exist',
                    'status' => 'FAILED'
                ]
            );
            exit();
        }

        $query = $conn->query("INSERT INTO categories(name) values('$name')");

        if($query){
            echo json_encode([
                'res' => '200',
                'status' => 'SUCCEED',
                'massage' => 'Category saved'
            ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }
?>