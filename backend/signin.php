<?php

include('connection.php');


header("Content-Type: application/json");
$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'];
$password = $data['password'];

// $username = "omar33";
// $password = "1234567";

$query = $mysqli->prepare('select id,username,password,first_name,last_name
from users 
where username=?');
$query->bind_param('s', $username);
$query->execute();

$query->store_result();
$query->bind_result($id, $username, $hashed_password, $first_name, $last_name);
$query->fetch();

$num_rows = $query->num_rows();
if ($num_rows == 0) {
    $response['status'] = "user not found";
} else {
    if (password_verify($password, $hashed_password)) {
        $response['status'] = 'loggedin';
        $response['user_id'] = $id;
        $response['username'] = $username;
        $response['first_name'] = $first_name;
        $response['last_name'] = $last_name;
    } else {
        $response['status'] = "wrong password";
    }
}
echo json_encode($response);

?>