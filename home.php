<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Images/Zampa.png">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Sora:wght@400&family=Acme" rel="stylesheet">
    <link rel="stylesheet" href="navigation.css?v=<?php echo time(); ?>">
    <script src="dogApi.js?v=<?php echo time(); ?>" defer></script>
    <script src="home.js?v=<?php echo time(); ?>" defer></script>
    <script src="likes.js?v=<?php echo time(); ?>" defer></script>
    <title>HOME</title>
</head>

<body>
    <article>
        <section id="LeftBar">
            <div>
                <img src="Images/Logo.png" alt="Logo" id="Logo">
                <a href="home.php"><p>Home</p></a>
                <a href="personal.php"><p>Il mio profilo</p></a>
                <a href="searchUser.php"><p>Cerca utente</p></a>
                <a href="logout.php"><p>Logout</p></a>
            </div>
        </section>

        <section id="CentralBar">
        </section>

        <section id="RightBar">
            <a href="NewPost.php" id="CreaPost">
                <button>Crea un nuovo Post</button>
            </a>
            <button id="CreaFoto">Genera foto</button>
            <div id="imgContainer"></div>
        </section>
    </article>
</body>
</html>