<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "DELETE FROM likes WHERE user='".$_SESSION['username']."'";
mysqli_query($conn, $query);
$query = "DELETE FROM posts WHERE user='".$_SESSION['username']."'";
mysqli_query($conn, $query);
$query = "DELETE FROM users WHERE username='".$_SESSION['username']."'";



if(mysqli_query($conn, $query)){
    session_destroy();
    header("Location: login.php");
    exit;
} else {
    $_SESSION['elimina'] = true;
    header("Location: personal.php");
    exit;
}
?>