<?php

    session_start();
    if(isset($_SESSION["username"]))
    {
        header("Location: home.php");
        exit;
    }

    if(!empty($_POST["username"]) && !empty($_POST["password"]))
    {
        $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
        $res = mysqli_query($conn, $query);

        if(mysqli_num_rows($res)>0)
        {
            $resArray = mysqli_fetch_assoc($res);
            if ($_POST['password'] == $resArray['password'] && $_POST['username'] == $resArray['username']) {
                $_SESSION["username"] = $_POST["username"];
                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            } else {
                $invalid = true;
            }
        } else {
            $invalid = true;
        }
    } else if(isset($_POST["username"])){
        $empty = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Sora:wght@400&family=Acme" rel="stylesheet">
    <link rel="icon" href="Images/Zampa.png">
    <title>HW1</title>
    <link rel="stylesheet" href="access.css?v=<?php echo time(); ?>">
    <script src="login.js?v=<?php echo time(); ?>" defer></script>
</head>
<body>

    <article>
        <section>
            <img src="Images/Logo.png" alt="Logo">
        </section>
        
        <main>
            <h1>ACCEDI</h1>
            <form name="Form"  method="post">
                <p class="errore">
                    <?php
                            if(isset($invalid)){
                                echo "Credenziali non valide.";
                            } elseif(isset($empty)){
                                echo "Riempi tutti i campi";
                            }
                    ?>
                </p>
                <p>
                <label><input type="text" name="username"> Username</label>
                </p>
                <p>
                <label><input type="password" name="password"> Password</label>
                </p>
                <p>
                <label id="submitlabel"><input type="submit" value=""></label>
                </p>
                <div>Non hai un account? <a href="SignUp.php">Registrati</a></div>
            </form>
        </main>
    </article>
</body>
</html>