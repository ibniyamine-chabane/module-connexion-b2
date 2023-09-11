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
                $logged = true;
                break;
            }
        }
    
        if ($logged) {
            echo "Vous êtes connecté";
        } else {
            echo "Erreur dans le login ou le mot de passe";
        }
    }
    

    public function updateLogin(string $login) {

    }

    public function updatePassword() {

    }
} 

?>