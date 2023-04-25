<?php
require_once('../../config/db.php');
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name       = $_POST['name'];
    $email     = $_POST['email'];
    $password             = md5($_POST['password']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    $queryCheckEmail = mysqli_query($conn, "SELECT * FROM users WHERE
					email = '$email' LIMIT 1");
    $checkRegisteredEmail = array();
    while ($row = mysqli_fetch_object($queryCheckEmail)) {
        $checkRegisteredEmail[] = $row;
    }
    if (count($checkRegisteredEmail) == 1) {
        http_response_code(406);
        $response = array(
            'status' => 'failed',
            'message' => 'Failed to register, email has been registered.'
        );
    } else {
        $sql =
            mysqli_query($conn, "INSERT INTO users SET
    				name = '$name',
    				email = '$email',
    				password = '$password',
                    created_at = '$created_at',
                    updated_at = '$updated_at'");
        if ($sql) {
            http_response_code(200);
            $response = array(
                'status' => 'success',
                'message' => 'Register Successfully.'
            );
        } else {
            http_response_code(400);
            $response = array(
                'status' => 'failed',
                'message' => 'Register Failed.'
            );
        }
    }
} else {
    http_response_code(406);
    $response = array(
        'status' => 'failed',
        'message' => 'Failed to register, check your input and try again.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
