<?php
session_start();

$postID = urlencode($_GET['postID']);
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "DELETE FROM likes where user='".$_SESSION['username']."' AND post=".$postID;
mysqli_query($conn, $query);

$query = "SELECT id, nlikes FROM posts WHERE id=".$postID;
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($res);
echo json_encode($row);

?>