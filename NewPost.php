<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit;
}


if (isset($_FILES['postImg'])) {
    $file = $_FILES['postImg'];
    $type = exif_imagetype($file['tmp_name']);
    $allowedExt = array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');
    if (isset($allowedExt[$type])) {
        if ($file['error'] === 0) {
            if ($file['size'] < 7000000) {
                $fileNameNew = uniqid('', true).".".$allowedExt[$type];
                $fileDestination = 'DataImage/'.$fileNameNew;
                move_uploaded_file($file['tmp_name'], $fileDestination);
            } else {
                $error['img'] = "L'immagine non deve avere dimensioni maggiori di 7MB";
            }
        } else {
            $error['img'] = "Errore nel carimento del file";
        }
    } else {
        $error['img'] = "I formati consentiti sono .png, .jpeg, .jpg e .gif";
    }
    
    if(!isset($error)){
        $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
        $user = $_SESSION['username'];
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        $query = "INSERT INTO posts(user, image, description) VALUES('$user', '$fileDestination', '$desc')";
        if (mysqli_query($conn, $query)) {
            header("Location: home.php");
            exit;
        } else {
            $error[] = "Errore di connessione al Database";
        }
        mysqli_close($conn);
    }
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
    <script src="NewPost.js?v=<?php echo time(); ?>" defer></script>
    <title>Crea un nuovo post</title>
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

        <section id="CentralBarN">
            <div class="create">

                <form name="Form" method="post" enctype="multipart/form-data" autocomplete="off">
                    <label>
                        Inserisci un'immagine:<br>
                        <div class="error"><?php  if(isset($errors['img'])) print_r($errors['img']); ?></div>
                        <input type='file' name='postImg' accept='.jpg, .jpeg, image/gif, image/png' id="postImg">
                    </label>
                    <label>
                        Inserisci una descrizione:<br>
                        <textarea name="description"></textarea>
                    </label>
                    <label>
                        <input type="submit" value="Pubblica" id="SubmitPost">
                    </label>
                </form>

            </div>
        </section>

        <section id="RightBar">
            <button id="CreaFoto">Genera foto</button>
            <div id="imgContainer"></div>
        </section>
    </article>
</body>
</html>