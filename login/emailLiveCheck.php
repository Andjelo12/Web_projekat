<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);

$conn = new mysqli("localhost", "tim", "Xj3W3WLgQeQxOp6", "tim");
$stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
$stmt->bind_param("s", $obj->email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows() > 0){
    $rez=array('E-mail already in use');
    echo json_encode($rez);
}else
    echo '';