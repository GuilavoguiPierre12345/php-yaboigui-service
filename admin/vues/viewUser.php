<?php
// appel du code de la connection à la bd
    require "database.php";

    if(!empty($_GET['id'])){
        $id = checkinput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare("SELECT users.id, users.nom, users.prenom, users.sexe, users.contact,users.email,users.login
                                FROM users WHERE users.id=?");
    $statement->execute(array($id));
    
    $user = $statement->fetch();
//fermeture de la connection à la base donnée
    Database::disconnect();

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
        <script src="../../bootstrap/jquery.min.js"></script>
        <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
        <script src="../../bootstrap/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../../css/style.css">
        <title>yaboïgui | afficher </title>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Voir un utilisateur : </strong></h1>
                    <br>
                    <form>
                        <div class="form-group h3">
                            <label>Nom :</label><?php echo ' '. $user['nom'];?>
                        </div>   
                        <div class="form-group h3">
                            <label>Prenom :</label><?php echo ' '. $user['prenom'];?>
                        </div>     
                        <div class="form-group h3">    
                            <label>Genre :</label><?php echo ' '. $user['sexe'];?><br>
                        </div>   
                        <div class="form-group h3"> 
                            <label>Contact :</label><?php echo ' '.$user['contact'];?><br>
                        </div> 
                        <div class="form-group h3"> 
                            <label>Email :</label><?php echo ' '.$user['email'];?><br>
                        </div> 
                        <div class="form-group h3"> 
                            <label>Login :</label><?php echo ' '.$user['login'];?><br>
                        </div>  
                    </form>
                    <div class="form-action">
                        <a href="gestionUser.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
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