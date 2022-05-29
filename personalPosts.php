<?php
session_start();
if(isset($_GET['q'])){
    $searched = $_GET['q'];
}
else {
    $searched = $_SESSION['username'];
}
$searcher = $_SESSION['username'];
$conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
$query = "SELECT * FROM (SELECT * FROM posts p join users u on u.username = p.user WHERE username = '".$searched."') a left join (SELECT * FROM likes l WHERE user = '".$searcher."') b on a.id = b.post";
$res = mysqli_query($conn, $query);
$results = array();
while($row = mysqli_fetch_assoc($res)){
    $results[] = $row;
}
echo json_encode($results);
   
?>