<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit;
}


if (isset($_FILES['profileImg'])) {
    $file = $_FILES['profileImg'];
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
        $query = "UPDATE users SET profile = '".$fileDestination."' WHERE username = '".$user."'";
        if (mysqli_query($conn, $query)) {
            header("Location: personal.php");
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
    <script src="personal.js?v=<?php echo time(); ?>" defer></script>
    <script src="likes.js?v=<?php echo time(); ?>" defer></script>
    <title>Il mio profilo</title>
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
            <div id="personal">
                    <img src="" alt="propic">
                    <div>
                        <p class="AName"></p>
                        <p class="AUser"></p>
                        <button id="profileButton">Cambia la foto profilo</button>
                        <a href="eliminaUtente.php">
                            <button class="elimina">Elimina account</button>
                        </a>
                </div>
            </div>

            <div class="error"><?php if(isset($_SESSION['elimina']))if($_SESSION['elimina']){echo 'Qualcosa è andato storto'; $_SESSION['elimina'] = false;} ?></div>

            <form name="profile" method=post class="hidden" id="profileForm" enctype="multipart/form-data" autocomplete="off">
                <label>
                    Inserisci un'immagine:<br>
                    <div class="error"><?php  if(isset($errors['img'])) print_r($errors['img']); ?></div>
                    <input type='file' name='profileImg' accept='.jpg, .jpeg, image/gif, image/png' id="profileImg">
                </label>
                <label>
                    <input type="submit" value="Inserisci" id="profileSubmit">
                </label>
            </form>

            <h1>I MIEI POST</h1>
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