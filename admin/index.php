<?php
    session_start();
    
    require "vues/database.php";
        $loginerror = $mdperror = "";
        $champsrempli = true;
        // $connexionvalide = true;
    if(!empty($_POST)){
        $login =verifieValeur($_POST['login']);
        $mdp =verifieValeur($_POST['mdp']);
        $_SESSION['login'] = $login;
        if(empty($login)){
            $champsrempli = false;
            $loginerror = "Ce champs login ne peut pas être vide !!";
        }
        if(empty($mdp)){
            $champsrempli = false;
            $mdperror = "Ce champs mot de passe ne peut pas être vide !!";
        }
        if($champsrempli){
            $db = Database::connect();
            $statement = $db->query("SELECT * FROM admins");
            while($admin = $statement->fetch()){
                if(($admin['login'] == $login) && ($admin['mdp']==$mdp)){
                    header('Location:vues/pageAdmin.php');
                }
                    // $connexionvalide = false;
            }
            // if($connexionvalide){
            //     header('Location:gestion.php');
            // }else{
            //     header('location:index.php');
            // }
        }
 }

 function verifieValeur($donnee){
    $donnee = trim($donnee);
    $donnee = stripslashes($donnee);
    $donnee = htmlspecialchars($donnee);
    return $donnee;
 }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="../bootstrap/jquery.min.js"></script>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <script src="../bootstrap/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/style.css">
        <title>Burger Code</title>
        <style>
            label{font-size: 20px;}
            .style{border: 5px solid ;border-radius: 4px;box-shadow: 3px 3px tan;}
            .style:hover{border: 5px ridge blue;border-radius: 5px;box-shadow: 5px -7px magenta;}
            .style:hover strong{border-bottom: 5px solid black;}
        </style>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 style admin">
                    <h1 style="text-align:center ;">
                        <strong>Connection</strong>
                    </h1><br>
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label for="login" class="label-control">login : </label>
                            <input type="text" name="login" id="login" class="form-control input-lg">
                            <span class="help-inline"><?php echo $loginerror; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="mdp" class="label-control">mot de passe : </label>
                            <input type="password" name="mdp" id="mdp" class="form-control input-lg">
                            <span class="help-inline"><?php echo $mdperror; ?></span>
                        </div>
                        <div class="form-group">
                            <button style="width:100% ;" type="submit" class="btn btn-success btn-lg ">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>