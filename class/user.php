<?php

class User {

    private $login;
    private $firstname;
    private $lastname;
    private $database;
    private $messageUpdateLogin;
    private $messageUpdatePw;
    private $message;

    public function __construct() {
        try {
            $this->database = new PDO('mysql:host=localhost;dbname=moduleconnexionb2;charset=utf8;port=3307', 'root', '');
            // $this->database = new PDO('mysql:host=localhost;dbname=moduleconnexionb2;charset=utf8;port=3307', 'root', '');
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function register(string $login, string $firstname, string $lastname, string $password) {
        $this->login = $login;
    
        $request = $this->database->prepare('SELECT * FROM user WHERE `login` = ?');
        $request->execute(array($login));
        $userDatabase = $request->fetchAll(PDO::FETCH_ASSOC);
        $loginOk = true; 
    
        foreach ($userDatabase as $user) {
            if ($login == $user['login']) {
                $this->message = "Cet utilisateur existe déjà";
                $loginOk = false;
                break;
            }
        }
    
        if ($loginOk) {
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $request = $this->database->prepare("INSERT INTO user(login, firstname, lastname, password) VALUES (?, ?, ?, ?)");
            $result = $request->execute(array($login, $firstname, $lastname, $hashedPassword));
    
            if ($result) {
                $this->message = "Inscription réussie";
                header('Location: login.php');
            } else {
                $this->message = "Erreur lors de l'inscription";
            }
        }
    }
    
    public function connection(string $login, string $password) {

        $this->login = $login;
        $request = $this->database->prepare('SELECT * FROM user WHERE `login` = ?');
        $request->execute(array($login));
        $userDatabase = $request->fetchAll(PDO::FETCH_ASSOC);
        $logged = false;
    
        foreach ($userDatabase as $user) {
            if ($this->login == $user['login'] && password_verify($password, $user['password'])) {
                $_SESSION['login'] = $this->login;
                $_SESSION['id_user'] = $user['id'];
                $logged = true;
                break;
            }
        }
    
        if ($logged) {
            header("Location: index.php");
        } else {
            $this->message = "Erreur dans le login ou le mot de passe";
        }
    }
    

    public function updateLogin(string $login, string $firstname, string $lastname, string $password) {

        $this->login = $login;
        $request = $this->database->prepare("SELECT COUNT(*) FROM user WHERE `login` = ?");
        $request->execute(array($this->login));
        $userDatabase = $request->fetchAll(PDO::FETCH_ASSOC);
        
        $requestUserLogged = $this->database->prepare("SELECT * FROM user WHERE `login` = ?");
        $requestUserLogged->execute(array($_SESSION['login']));
        $userLoggedData = $requestUserLogged->fetchAll(PDO::FETCH_ASSOC);
        $loginAvailable = true;
         
        if ($userDatabase[0]['COUNT(*)'] > 0) {
            $loginAvailable = false;
            $this->messageUpdateLogin = "Ce login est déjà pris";
        }

        if (password_verify(!$password, $userLoggedData[0]['password'])) {
            
            $this->messageUpdateLogin = "Le mot de passe et invalide";

        } else if ($loginAvailable = true && password_verify($password, $userLoggedData[0]['password'])) {
            $request = $this->database->prepare("UPDATE user SET `login` = (?), `firstname` = (?), `lastname` = (?) 
                                                 WHERE user.id = (?)");
            $request->execute(array($this->login, $firstname, $lastname, $_SESSION['id_user']));
            $_SESSION['login'] = $this->login;
            $this->messageUpdateLogin = "Le login a bien été changé";
            // echo "Le login a bien été changé";
        }

    }

    public function updatePassword(string $password) {
        
        $hashedPassword = password_hash($password ,PASSWORD_DEFAULT);
        $request = $this->database->prepare("UPDATE user SET `password` = (?) WHERE user.id = (?)");
        $request->execute(array($hashedPassword, $_SESSION['id_user']));
        $this->messageUpdatePw = "mot de passe modifié avec succes";

    }

    public function getMessage() {
        return $this->message;
    }

    public function getMessageUpdateLogin() {
        return $this->messageUpdateLogin;
    }
    public function getMessageUpdatePassword() {
        return $this->messageUpdatePw;
    }
    public function getUserLogged() {
        $request = $this->database->prepare("SELECT * FROM user WHERE `id` = ?");
        $request->execute(array($_SESSION['id_user']));
        return $userData = $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $request = $this->database->prepare("SELECT * FROM user");
        $request->execute(array());
        return $userData = $request->fetchAll(PDO::FETCH_ASSOC);
    }


} 

?>