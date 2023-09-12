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
        <section>
            <?php if (isset($_SESSION['login'])) : ?>
                <div>
                    <h2>Bonjour <?= $_SESSION['login'] ?></h2>
                </div>
            <?php else: ?>
                <div>
                    <h2>Bonjour inviter</h2>
                </div>
            <?php endif; ?>    
        </section>    
    </main>
</body>
</html>