<?php 
    require "../../admin/vues/database.php";
    
    // initialisation des variables d'erreur
    $erreurnom = $erreurprenom = $erreurcontact = $erreuremail = $erreurlogin = $erreurmdp = "";

    if(!empty($_POST)){
        $nom = checkinput($_POST['nom']);
        $prenom = checkinput($_POST['prenom']);
        $contact = checkinput($_POST['contact']);
        $email = checkinput($_POST['email']);
        $login = checkinput($_POST['login']);
        $mdp = md5(checkinput($_POST['mdp']),true);
        $sexe = checkinput($_POST['genre']);
        $estvalide = true;

        if(empty($nom)){
            $erreurnom = "veuillez remplir le champs de nom";
            $estvalide = false;
        }
        if(empty($prenom)){
            $erreurprenom = "veuillez remplir le champs de prenom";
            $estvalide = false;
        }
        if(empty($contact)){
            $erreurcontact = "veuillez remplir le champs de contact";
            $estvalide = false;
        }
        if(empty($login)){
            $erreurlogin = "veuillez remplir le champs de login";
            $estvalide = false;
        }
        if(empty($mdp)){
            $erreurmdp = "veuillez remplir le champs de mot de passe";
            $estvalide = false;
        }
        if(empty($email)){
            $erreuremail = "veuillez remplir le champs d'email";
            $estvalide = false;
        }else{
            $email = filter_var($email,FILTER_VALIDATE_EMAIL);
        }

        if($estvalide){
            $db = Database::connect();
            $doublon = $db->prepare("SELECT * FROM users WHERE contact=? OR email=?");
            $doublon->execute(array($contact,$email));
            if(($doublon->rowCount()) !=0){
                $erreurcontact = $erreuremail = "l'email ou le contact existe deja";
            }else{
                $statement = $db->prepare("INSERT INTO users(nom,prenom,sexe,contact,email,login,mdp)
                                        VALUES(?,?,?,?,?,?,?)");
                $statement->execute(array($nom,$prenom,$sexe,$contact,$email,$login,$mdp));
                header('location:connexion.php');
            }

            
        }



    }



    /**cette fonction est écrite pour pouvoir éviter les failles xss */
    function checkinput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>