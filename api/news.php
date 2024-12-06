<?php
    include "./connect.php";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $query = $conn->query("SELECT * FROM news");

        $datas = [];

        foreach($query as $i => $data){
            $datas[] = array(
                'name' => $data['name'],
                'content' => $data['content']
            );
        }

        if($datas !== []){
            echo json_encode([
                'res' => '200',
                'data' => $datas,
                'status' => 'SUCCEED'
            ]);
            exit();
        }
        echo json_encode([
            'res' => '200',
            'massage' => 'No data'
        ]);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $name = $_POST['name'];
        $content = $_POST['content'];

        $check = $conn->query("SELECT * FROM news WHERE name='$name' AND content='$content'");

        if($check->num_rows > 0){
            echo json_encode(
                [
                    'res' => '400',
                    'massage' => 'News already exist',
                    'status' => 'FAILED'
                ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                exit();
        }

        $query = $conn->query("INSERT INTO news(name, content) VALUES('$name', '$content')");

        if($query){
            echo json_encode([
                'res' => '200',
                'status' => 'SUCCEED',
                'massage' => 'News saved'
            ],JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }
    }
?>