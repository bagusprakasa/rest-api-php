<?php

session_start();
session_destroy();

header('Content-Type: application/json');
$response = array(
    'status' => 'success',
    'message' => 'Logout Successfully.',
);
echo json_encode($response);
