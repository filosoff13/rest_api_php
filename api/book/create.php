<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once '../../config/Database.php';
include_once '../../models/Books.php';

$database = new Database();
$db = $database->connect();

$post = new Books($db);
// Get raw posted data
$data = json_decode(file_get_contents("php://input"));
$post->title = $data->title;

if ($post->create()) {
    echo json_encode(
        array('message' => 'Book Created')
    );
} else {
    echo json_encode(
        array('message' => 'Book Not Created')
    );
}