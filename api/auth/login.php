<?php
require_once('../../config/db.php');
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email     = $_POST['email'];
    $password             = md5($_POST['password']);
    $queryCheckEmail = mysqli_query($conn, "SELECT * FROM users WHERE
					email = '$email' AND password = '$password' LIMIT 1");
    $login = array();
    while ($row = mysqli_fetch_object($queryCheckEmail)) {
        $login[] = $row;
    }
    session_start();

    if (isset($_SESSION['email'])) {
        header("Location: berhasil_login.php");
    }
    if (count($login) != 1) {
        http_response_code(406);
        $response = array(
            'status' => 'failed',
            'message' => 'Failed to login, account not found.'
        );
    } else {
        http_response_code(200);
        $_SESSION['id'] = $login[0]->id;
        $_SESSION['name'] = $login[0]->name;
        $_SESSION['email'] = $login[0]->email;
        $session = array(
            "email" => $login[0]->email,
            "name" => $login[0]->name,
        );
        $response = array(
            'status' => 'success',
            'message' => 'Login Successfully.',
            'data' =>  $session,
        );
    }
} else {
    http_response_code(406);
    $response = array(
        'status' => 'failed',
        'message' => 'Failed to login, check your input and try again.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
