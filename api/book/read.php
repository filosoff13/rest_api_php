<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../../config/Database.php';
include_once '../../models/Books.php';

$database = new Database();
$db = $database->connect();

$post = new Books($db);
$result = $post->read();

$num = $result->rowCount();

if($num > 0) {

    $posts_arr = array();
    // $posts_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title
        );

        array_push($posts_arr, $post_item);

    }

    echo json_encode($posts_arr);
} else {

    echo json_encode(
        array('message' => 'No Books Found')
    );
}