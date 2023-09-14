<?php 
session_start();

if (isset($_SESSION['id_user']) && $_SESSION['id_user'] !== 1) {
    header("Location: index.php");
} else if (!$_SESSION) {
    header("Location: index.php");
}
require_once("class/user.php");
$moduleConnection = new User;

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
    <title>Admin</title>
</head>
<body>
    <?php require_once("header.php"); ?>
    <main>
        <section>
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100">
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th class="column1">Id</th>
                                    <th class="column2">Login</th>
                                    <th class="column3">Prénom</th>
                                    <th class="column4">Nom</th>
                                    <th class="column6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $moduleConnection->getAllUsers() as $user) : ?>
                                <tr>
                                    <td class="column1"><?= $user['id'] ?></td>
                                    <td class="column2"><?= $user['login'] ?></td>
                                    <td class="column3"><?= $user['firstname'] ?></td>
                                    <td class="column4"><?= $user['lastname'] ?></td>
                                    <td class="column6">
                                        <?php if($user['id'] == 1) : ?>
                                            <span>Action impossible</span>
                                        <?php else: ?>    
                                            <a href="delete.php?id_u=<?= $user['id']?>" class="action-button">Delete <?= $user['login'] ?></a>
                                        <?php endif; ?>
                                    </td>
                                            
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>    
    </main>
</body>
</html>