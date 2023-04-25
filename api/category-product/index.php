<?php

session_start();

if (!isset($_SESSION['name'])) {
    http_response_code(401);
    $response = array(
        'status' => 'failed',
        'message' => 'Failed to login, check your input and try again.'
    );
} else {
    http_response_code(200);
    $response = array(
        'status' => 'success',
        'message' => 'Login Successfully.',
    );
}
header('Content-Type: application/json');
echo json_encode($response);
