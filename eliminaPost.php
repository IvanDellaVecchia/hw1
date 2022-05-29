<?php
session_start();
$post = $_GET['q'];
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "DELETE FROM likes WHERE post='".$post."'";
mysqli_query($conn, $query);
$query = "DELETE FROM posts WHERE id='".$post."'";
mysqli_query($conn, $query);
?>