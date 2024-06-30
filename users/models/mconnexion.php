<?php 
    session_start();

    require "../../admin/vues/database.php";
    $errorlogin = $errormdp = "";

    if(!empty($_POST)){
        $login  = checkinput($_POST['login']);
        $mdp    = checkinput($_POST['mdp']);
        $infoSaisie = true;

        if(empty($login)){
            $errorlogin = "veuillez remplir le champs login";
            $infoSaisie = false;
        }
        if(empty($mdp)){
            $errormdp = "veuillez remplir le champs mot de passe";
            $infoSaisie =false;
        }

        if(!$infoSaisie){
            // $errorlogin = $errormdp = "une des informations est incorrecte";

        }
            // header('location:connexion.php');
        else{
            $db = Database::connect();
            $statement = $db->query("SELECT * FROM users");
            
            $trouve = false;
            while($user = $statement->fetch()){
                if(($user['login'] == $login) && $user['mdp'] == md5($mdp,true)){
                    $trouve = true; 
                    $_SESSION['loginuser'] = $login;
                    $_SESSION['id']=$user['id'];
                    break;
                }else{
                    $errorlogin = $errormdp = "veuillez remplir correctement!!";
                }
            }
            if($trouve){
                header('location:accueil.php');
            }
            Database::disconnect();
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