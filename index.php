<?php 
session_start();
require_once("class/user.php");
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
    <title>Accueil</title>
</head>
<body>
    <?php require_once("header.php"); ?>
    <main>
        <section class="home-text-position">
            <article>
                <div class="container-home">
                    <?php if (isset($_SESSION['login'])) : ?>
                        <div>
                            <h2>Bonjour <?= $_SESSION['login'] ?></h2>
                        </div>
                    <?php else: ?>
                        <div>
                            <h2>Bonjour inviter</h2>
                        </div>
                    <?php endif; ?>
                </div>  
                <div>
                    <h3>Bienvenue sur Module de Connexion</h3>
                    <p>Je suis ravis de vous accueillir sur Module de connexion, 
                       un projet passionnant que j'ai développé dans le cadre de ma formation à La Plateforme_. 
                       J'ai conçue ce site pour vous offrir une expérience utilisateur exceptionnelle,
                       tout en mettant en pratique les compétences que j'ai acquis dans le cadre de ma formation.
                    </p>
                    <p>
                        il sera possible de dans ce site de :<br>
                        <strong>S'inscrire</strong> : avec un login, prénom, nom et mot de passe. <br>
                        <strong>Se Connecter</strong> : se connceter à votre compte avec le login et le mot de passe 
                        que vous aurez choisie lors de votre inscription.<br>
                        <strong>Modifier sont profil</strong> : Mettez à jour vos informations à tout moment. 
                        Que ce soit votre login, prénom, nom ou mot de passe. 
                    </p>
                    <div class="home-button-box">
                        <a href="login.php" class="action-button home-button">Connexion</a>
                        <a href="register.php" class="action-button home-button">Inscription</a>
                    </div>
                </div>
            </article>  
        </section>    
    </main>
</body>
</html>