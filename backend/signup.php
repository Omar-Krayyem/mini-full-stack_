<?php

include('connection.php');



$response = array();
$json_data = file_get_contents("php://input");
$data = json_decode($json_data,true);

$username = $data['username'];
$password = $data['password'];
$first_name = $data['first_name'];
$last_name = $data['last_name'];


$check_username = $mysqli->prepare('select username from users where username=?');
$check_username->bind_param('s', $username);
$check_username->execute();
$check_username->store_result();
$username_exists = $check_username->num_rows();

if ($username_exists == 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = $mysqli->prepare('insert into users(username,password,first_name,last_name) values(?,?,?,?)');
    $query->bind_param('ssss', $username, $hashed_password, $first_name, $last_name);
    $query->execute();

    $response['status'] = "success";
    $response['message'] = "another message in success";
    $response['username'] = $username;
} else {
    $response['status'] = "failed";
    $response['message'] = "another message in fail";
}

echo json_encode($response);

// types of http request : POST,GET,PUT,DELETE 