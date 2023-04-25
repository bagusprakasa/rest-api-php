<?php
session_start();
$email     = $_POST['email'];
$password             = md5($_POST['password']);
$queryCheckEmail = mysqli_query($conn, "SELECT * FROM users WHERE
					email = '$email' AND password = '$password' LIMIT 1");
$login = array();
while ($row = mysqli_fetch_object($queryCheckEmail)) {
    $login[] = $row;
}
echo $data;
if (isset($_SESSION['name'])) {
    header("Location: berhasil_login.php");
}
if (count($login) != 1) {
    http_response_code(406);
    $_SESSION['name'] = $row['username'];
    $response = array(
        'status' => 'failed',
        'message' => 'Failed to login, account not found.'
    );
} else {
    http_response_code(200);
    $response = array(
        'status' => 'success',
        'message' => 'Login Successfully.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
