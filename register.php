<?php
session_start();
require_once("class/user.php");
$moduleConnection = new User;
$message = "";


if (isset($_POST['submit'])) {

    if ($_POST['login'] && $_POST['firstname'] && $_POST['lastname'] && $_POST['password']) {

        if (strlen($_POST['password']) < 8) {

            $message = "Le mot de passe doit contenir au moins 8 caractères.";

        } else if (!preg_match("/[A-Z]/", $_POST['password'])) {

            $message = "Le mot de passe doit contenir au moins une lettre majuscule.";

        } else if (!preg_match("/[0-9]/", $_POST['password'])) {

            $message = "Le mot de passe doit contenir au moins un chiffre.";

        } else if (!preg_match("/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/", $_POST['password'])) {

            $message = "Le mot de passe doit contenir au moins un caractère spécial.";
            
        } else {
            $login = htmlspecialchars(trim($_POST['login']));
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $password = $_POST['password'];
            
            $moduleConnection->register($login, $firstname, $lastname, $password);
            $message = $moduleConnection->getMessage();
        }
            
    } else {
        $message = "Veuillez remplir tous les champs";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
    <script defer src="js/script.js"></script>
    <title>Inscription</title>
</head>
<body>
    <?php require_once("header.php"); ?>
    <main>
        <section>
            <form action="" class="form" method="post">
                <div class="title">Inscription</div>
                <?php if(isset($message) && !empty($message)) : ?>
                    <div class="subtitle"><?= $message ?></div>
                <?php endif; ?>
                <div class="input-container ic1">
                    <input id="login" name="login" class="input" type="text" placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="login" class="placeholder">Login</label>
                </div>
                <div class="input-container ic1">
                    <input id="firstname" name="firstname" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="firstname" class="placeholder">Prénom</label>
                </div>
                <div class="input-container ic2">
                    <input id="lastname" name="lastname" class="input" type="text" placeholder=" " />
                    <div class="cut cut-short"></div>
                    <label for="lastname" class="placeholder">Nom</label>
                </div>
                <div class="input-container ic2">
                  <input id="password" name="password" class="input" type="password" placeholder=" " />
                  <div class="cut cut-adjusted"></div>
                  <label for="password" class="placeholder">Mot de passe</label>
                </div>
                <button type="text" name="submit" class="submit">S'inscrire</button>
            </form>
        </section>
    </main>
</body>
</html>