<?php 
session_start();
require_once("class/user.php");
$moduleConnection = new user;
$moduleConnection->connection("karlo", "rockandstone");
// $moduleConnection->register("karl");
// var_dump($_SESSION['login']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
    <script defer src="js/script.js"></script>
    <title>Se connecter</title>
</head>
<body>
    <?php require_once("header.php"); ?>
    <div class="form">
        <div class="title">Connexion</div>
        <!-- <div class="subtitle">Let's create your account!</div> -->
        <div class="input-container ic1">
            <input id="firstname" name="firstname" class="input" type="text" placeholder=" " />
            <div class="cut"></div>
            <label for="firstname" class="placeholder">Prénom</label>
        </div>
        <div class="input-container ic2">
            <input id="lastname" name="lastname" class="input" type="text" placeholder=" " />
            <div class="cut"></div>
            <label for="lastname" class="placeholder">Nom</label>
        </div>
        <div class="input-container ic2">
            <input id="email" class="input" type="text" placeholder=" " />
            <div class="cut cut-short"></div>
            <label for="email" class="placeholder">Email</>
        </div>
        <button type="text" class="submit">submit</button>
    </div>
    
</body>
</html>