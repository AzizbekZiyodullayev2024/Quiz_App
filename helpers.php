<?php
function view (string $page, array $data = []){
    extract($data);
    require 'resources/views/' . $page . '.php';
    exit();
}
function redirect (string $url){
    header('Location: ' . $url);
    exit();
}
function apiResponse($data, $status = 200) : void{
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit();
}