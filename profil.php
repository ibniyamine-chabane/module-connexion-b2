<?php
session_start();
require_once("class/user.php");
$moduleConnection = new user;
$messageUpdateLogin = "";
$userLoggedData = $moduleConnection->getUserLogged();

if (isset($_POST['submit-info'])) {

    if ($_POST['login'] && $_POST['firstname'] && $_POST['lastname'] && $_POST['password-valid-login']) {
        
        $login = htmlspecialchars($_POST['login']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $password = $_POST['password-valid-login'];
        $moduleConnection->updateLogin($login, $firstname, $lastname, $password);
        $messageUpdateLogin = $moduleConnection->getMessageUpdateLogin();
    } else {
        $messageUpdateLogin = "veuillez remplir tous les champs";
    } 
}

// var_dump($moduleConnection->updateLogin("karlabinanano", "karlitomomo", "dwarf", "rockandstone",));
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
    <title>Profil</title>
</head>
<body>
    <?php require_once("header.php"); ?>
<main>
    <section>
        <div class="flex">
            <form action="" class="form" method="post">
                <div class="title">Changer le login</div>
                <?php if(isset($messageUpdateLogin) && !empty($messageUpdateLogin)) : ?>
                    <div class="subtitle"><?= $messageUpdateLogin ?></div>
                <?php endif; ?>
                <div class="input-container ic1">
                    <input id="login" name="login" class="input" type="text" placeholder=" " value="<?=$userLoggedData[0]['login'] ?>" />
                    <div class="cut"></div>
                    <label for="login" class="placeholder">Login</label>
                </div>
                <div class="input-container ic1">
                    <input id="firsname" name="firstname" class="input" type="text" placeholder=" " value="<?=$userLoggedData[0]['firstname'] ?>" />
                    <div class="cut"></div>
                    <label for="firsname" class="placeholder">Prénom</label>
                </div>
                <div class="input-container ic1">
                    <input id="lastname" name="lastname" class="input" type="text" placeholder=" " value="<?=$userLoggedData[0]['lastname'] ?>" />
                    <div class="cut"></div>
                    <label for="lastname" class="placeholder">Nom</label>
                </div>
                <div class="input-container ic2">
                    <input id="password-valid-login" name="password-valid-login" class="input" type="password" placeholder=" " />
                    <div class="cut radius-password"></div>
                    <label for="password-valid-login" class="placeholder">Confirmation avec mot de passe</label>
                </div>
                <button type="submit" name="submit-info" class="submit">Modifier les infos</button>
            </form>

            <form action="" class="form" method="post">
                <div class="title">Changer le Mot de passe</div>
                <?php if(isset($message) && !empty($message)) : ?>
                    <div class="subtitle"><?= $message ?></div>
                <?php endif; ?>
                <div class="input-container ic1">
                    <input id="current-password" name="current-password" class="input" type="password" placeholder=" " />
                    <div class="cut radius-current-password"></div>
                    <label for="login" class="placeholder">Mot de passe Actuel</label>
                </div>
                <div class="input-container ic2">
                    <input id="new-password" name="new-password" class="input" type="password" placeholder=" " />
                    <div class="cut radius-current-password"></div>
                    <label for="new-password" class="placeholder">Nouveau mot de passe</label>
                </div>
                <div class="input-container ic2">
                    <input id="confirm-password" name="confirm-password" class="input" type="password" placeholder=" " />
                    <div class="cut radius-confirm-password"></div>
                    <label for="confirm-password" class="placeholder">Confirmez le nouveau mot de passe</label>
                </div>
                <button type="submit" name="submit" class="submit">Modifier le mpd</button>
            </form>
        </div>
    </section>
</main>
    
</body>
</html>