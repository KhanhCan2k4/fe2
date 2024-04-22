<?php

$input = json_decode(file_get_contents("php://input"), true);

$users = [
    [
        "name" => "Nguyen Van A",
        "age" => 20
    ],
    [
        "name" => "Nguyen Van B",
        "age" => 25
    ],
    [
        "name" => "Nguyen Thi C",
        "age" => 19
    ]
];

$index = (int) $input['index'];

$user = $users[$index]?? null;

echo json_encode($user);