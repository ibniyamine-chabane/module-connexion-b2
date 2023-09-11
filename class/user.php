<?php

class user {

    private $login;
    private $firstname;
    private $lastname;
    private $database;
    private $message;

    public function __construct() {
        try {
            $this->database = new PDO('mysql:host=localhost;dbname=moduleconnexionb2;charset=utf8;port=3307', 'root', '');
            // $this->database = new PDO('mysql:host=localhost;dbname=moduleconnexionb2;charset=utf8;port=3307', 'root', '');
        } catch(Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        echo "La class user à bien été instancier";
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
            $this->message = "Vous êtes connecté";
        } else {
            $this->message = "Erreur dans le login ou le mot de passe";
        }
    }
    

    public function updateLogin(string $login, string $password) {

        $this->login = $login;
        $request = $this->database->prepare("SELECT * FROM user");
        $request->execute(array());
        $userDatabase = $request->fetchAll(PDO::FETCH_ASSOC);
        $loginChangeOk = false;
        var_dump($_SESSION['login']);

        foreach ($userDatabase as $user) {
            
            if ($this->login == $_SESSION['login'] && password_verify($password, $user['password'])) {
                $loginChangeOk = true;
            } else if ($this->login == $user['login']) {
                // $this->message = "Ce login est déjà utilisé par une autre utilisateur";
                echo "Ce login est déjà utilisé par une autre utilisateur";
                $loginChangeOk = false;
                break;
            }
        }

        if ($loginChangeOk == true) {
            $request = $this->database->prepare("UPDATE user SET `login` = (?), `password` = (?)
                                                 WHERE user.id = (?)");
            $request->execute(array($this->login, $password, $_SESSION['id_user']));
            $this->message = "Le login a bien été changé";
            echo "Le login a bien été changé";
        }

    }

    public function updatePassword() {

    }
} 

?>