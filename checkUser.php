<?php
session_start();
if(isset($_GET['q'])){
    $user = $_GET['q'];
}
else {
    $user = $_SESSION['username'];
}
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "SELECT * FROM users WHERE username = '".$user."'";
$res = mysqli_query($conn, $query);
echo json_encode(mysqli_fetch_assoc($res));
?>