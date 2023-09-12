<header>
    <div class="navbar">
        <div class="logo">
            <a href="#">Module de connexion</a>
        </div>
        <ul class="links">
            <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1) : ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="admin.php">Admin</a></li>
            <?php else: ?>
                <li><a href="index.php">Accueil</a></li>
            <?php endif; ?>
        </ul>
        <div class="buttons">
            <?php if(isset($_SESSION['id_user'])): ?>
                <a href="profil.php" class="action-button pro">Profil</a>
                <a href="logout.php" class="action-button">Déconnexion</a>
            <?php else :?>
                <a class="action-button pro">Inscription</a>
                <a href="login.php" class="action-button">Connexion</a>
            <?php endif; ?>
        </div>
        <div class="burger-menu-button">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="burger-menu">
        <ul class="links">
            <?php if (isset($_SESSION['id_user']) && $_SESSION['id_user'] == 1) : ?>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="admin.php">Admin</a></li>
            <?php else: ?>
                <li><a href="index.php">Accueil</a></li>
            <?php endif; ?>
            <div class="divider"></div>
            <div class="buttons-burger-menu">
            <?php if(isset($_SESSION['id_user'])): ?>
                <a href="profil.php" class="action-button pro">Profil</a>
                <a href="logout.php" class="action-button">Déconnexion</a>
            <?php else :?>
                <a href="register.php" class="action-button pro">Inscription</a>
                <a href="login.php" class="action-button">Connexion</a>
            <?php endif; ?>
            </div>
        </ul>
    </div>
</header>