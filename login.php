<?php 
session_start();

if(isset($_SESSION['id_user'])) {
    header("Location: index.php");
}

require_once("class/user.php");
$moduleConnection = new User;
$message = "";
if (isset($_POST['submit'])) {

    if ($_POST['login'] && $_POST['password']) {
        $login = htmlspecialchars($_POST['login']);
        $password = $_POST['password'];
        $moduleConnection->connection($login, $password);
        $message = $moduleConnection->getMessage();

    } else {
        $message = "veuillez remplir tous les champs";
    }   
}
 

?>
<!DOCTYPE html>
<html lang="fr">
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
    <main>
        <section>
            <form action="" class="form" method="post">
                <div class="title">Connexion</div>
                <?php if(isset($message) && !empty($message)) : ?>
                    <div class="subtitle"><?= $message ?></div>
                <?php endif; ?>
                <div class="input-container ic1">
                    <input id="login" name="login" class="input" type="text" placeholder=" " />
                    <div class="cut"></div>
                    <label for="login" class="placeholder">Login</label>
                </div>
                <div class="input-container ic2">
                    <input id="password" name="password" class="input" type="password" placeholder=" " />
                    <div class="cut"></div>
                    <label for="lastname" class="placeholder">Mot de passe</label>
                </div>
                <button type="submit" name="submit" class="submit">Se Connecter</button>
            </form>
        </section>
    </main>
</body>
</html>