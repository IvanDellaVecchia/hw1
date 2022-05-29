<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "SELECT * FROM (SELECT * FROM posts p join users u on u.username = p.user) a left join (SELECT * FROM likes l WHERE user = '".$_SESSION['username']."') b on a.id = b.post order by id";
$res = mysqli_query($conn, $query);
$results = array();
while($row = mysqli_fetch_assoc($res)){
    $results[] = $row;
}
echo json_encode($results);
   
?>