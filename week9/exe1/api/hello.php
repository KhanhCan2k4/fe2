<?php 

$input = json_decode(file_get_contents("php://input"), true);

$name = $input['name'];

echo json_encode("Hello <b>" . $name ."</b> :>");