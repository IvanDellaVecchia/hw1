<?php
session_start();
$errors = array();
if(!empty($_POST["nome"]) && !empty($_POST["cognome"]) && !empty($_POST["email"]) && !empty($_POST["username"]) && !empty($_POST["password"])){
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));

    if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST["username"])){
            $errors['username'] = "Username non valido"; 
    } else {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $query = "SELECT * FROM users WHERE username = '".$_POST["username"]."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)>0){
            $errors['username'] = "Username già esistente";
        }
    }

    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Email non valida";
    } else {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $query = "SELECT * FROM users WHERE email = '".$_POST["email"]."'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res)>0){
            $errors['email'] = "Email già esistente";
        }
    }

    if(strlen($_POST["password"]) < 8){
        $errors['password'] = "Password troppo corta";
    }

    if(count($errors) == 0){
        $nome = mysqli_real_escape_string($conn, $_POST["nome"]);
        $cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $query = "INSERT INTO users(name, surname, email, username, password) VALUES('$nome', '$cognome', '$email', '$username', '$password')";

        if(mysqli_query($conn, $query)){
            $_SESSION["username"] = $_POST["username"];
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        } else {
            $errors['conn'] = "Errore di connessione al DataBase";
        }
        mysqli_close($conn);
    }
} else if(isset($_POST["username"])){
    $errors['empty'] = "Riempi tutti i campi";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Sora:wght@400&family=Acme" rel="stylesheet">
    <link rel="icon" href="Images/Zampa.png">
    <title>Registrati</title>
    <link rel="stylesheet" href="access.css?v=<?php echo time(); ?>">
    <script src="SignUp.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>
    
    <article>
        <section>
            <img src="Images/Logo.png" alt="logo">
        </section>
        
        <main>
            <h1>REGISTRATI</h1>
            <form name="Form"  method="post">

                <?php
                    if(isset($errors['empty'])){
                        echo '<p class="errore">'.$errors['empty'].'</p>';
                    }
                    if(isset($errors['conn'])){
                        echo '<p class="errore">'.$errors['conn'].'</p>';
                    }
                ?>

                <div id="nome">
                    <label><input type="text" name="nome"> Nome</label>
                    <div class="errore"></div>
                </div>
                <div id ="cognome">
                    <label><input type="text" name="cognome"> Cognome</label>
                    <div class="errore"></div>
                </div>
                <div id="email">
                    <label><input type="text" name="email"> Email</label>
                    <div class="errore"><?php if(isset($errors['email'])) echo $errors['email'] ?></div>
                </div>
                <div id="username">
                    <label><input type="text" name="username"> Username</label>
                    <div class="errore"><?php if(isset($errors['username'])) echo $errors['username'] ?></div>
                </div>
                <div id="password">
                    <label><input type="password" name="password"> Password</label>
                    <div class="errore"><?php if(isset($errors['password'])) echo $errors['password'] ?></div>
                </div>
                <p>
                <label id="submitlabel"><input type="submit" value=""></label>
                </p>
                <div>Hai già un account? <a href="login.php">Accedi</a></div>
            </form>
        </main>
    </article>
</body>
</html>