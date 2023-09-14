<?php 

session_start();
if (isset($_SESSION['id_user']) && $_SESSION['id_user'] !== 1) {
    header("Location: index.php");
} else if (!$_SESSION) {
    header("Location: index.php");
}

require_once("class/user.php");
$moduleConnection = new User;
$moduleConnection->deleteUser($_GET['id_u']);

?>