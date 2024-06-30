<?php
    require "../models/includes/rootlink.php";
    require "database.php";

    // recupération de l'ID passer en GET par le bouton modifier de l'index.php
    if(!empty($_GET['id'])){
        $id = checkinput($_GET['id']);
    }

    // initialisation des variables d'erreur et de valeur
    $nameerror = $descriptionerror = $imageerror = $priceerror = $categoryerror = "";
    $nom = $prenom = $genre = $contact = $email = $login = $mdp = "";

    if(!empty($_POST)){
        $nom                = checkinput($_POST['nom']);
        $prenom             = checkinput($_POST['prenom']);
        $genre              = checkinput($_POST['genre']);
        $contact            = checkinput($_POST['contact']);
        $email              = filter_var(checkinput($_POST['email']),FILTER_VALIDATE_EMAIL);
        $login              = checkinput($_POST['login']);
        $mdp                = md5(checkinput($_POST['mdp']),true);
        $isSuccess          = true ;    //par défaut le formulaire est rempli
        // on vérifie les champs s'ils ne sont pas vide
        if(empty($nom)){
            $nameerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($prenom)){
            $descriptionerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($genre)){
            $priceerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($contact)){
            $categoryerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($email)){
            $categoryerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($login)){
            $categoryerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($mdp)){
            $categoryerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }

        // la vérification finale pour l'insertion dans la base de donnée
        if(($isSuccess)){
            // connection à la base de donnée
            $db = Database::connect();
            $statement = $db->prepare("UPDATE users SET nom=?, prenom=? ,sexe=? ,contact=?, email=?, login=?, mdp=? WHERE id=?");
            $statement->execute(array($nom,$prenom,$genre,$contact,$email,$login,$mdp,$id));
            Database::disconnect();
            header('Location:gestionUser.php');
        }
    }else{
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM users WHERE id =?");
        $statement->execute(array($id));
        $item = $statement->fetch();

        $nom               = $item['nom'];
        $prenom        = $item['prenom'];
        $genre           = $item['sexe'];
        $contact              = $item['contact'];
        $email              = $item['email'];
        $login              = $item['login'];
        $mdp              = $item['mdp'];

        Database::disconnect();
    }


    /**cette fonction est écrite pour pouvoir éviter les failles xss */
    function checkinput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?php echo $rootlink;?>/bootstrap/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo $rootlink;?>/bootstrap/css/bootstrap.css">
        <script src="<?php echo $rootlink;?>/bootstrap/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo $rootlink;?>/css/style.css">
        <title>yaboïgui | modifier </title>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier les infos d'un User: </strong></h1>
                    <br>
                    <form role="form" class="form" action="<?php echo 'updateUser.php?id='.$id;?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="label-control">Nom :</label>
                            <input class="input-lg form-control" type="text" name="nom" placeholder="nom element" value="<?php echo $nom ;?>">
                            <span class="help-inline"><?php echo $nameerror ;?></span>
                        </div>   
                        <div class="form-group">
                            <label class="label-control">Prenom :</label>
                            <input class="input-lg form-control" type="text" name="prenom" placeholder="description" value="<?php echo $prenom ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Genre :</label>
                            <input class="input-lg form-control" type="text" name="genre" placeholder="description" value="<?php echo $genre ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Contact :</label>
                            <input class="input-lg form-control" type="text" name="contact" placeholder="description" value="<?php echo $contact ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Email :</label>
                            <input class="input-lg form-control" type="text" name="email" placeholder="description" value="<?php echo $email ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Login :</label>
                            <input class="input-lg form-control" type="text" name="login" placeholder="description" value="<?php echo $login ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Mot de passe :</label>
                            <input class="input-lg form-control" type="text" name="mdp" placeholder="description" value="<?php echo $mdp ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 

                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                            <a href="gestionUser.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        </div>
                    </form>
                </div>

                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <span style="font-size:500px; width: 100%; height:100%;" class="glyphicon glyphicon-user"></span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>