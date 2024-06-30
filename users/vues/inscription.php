<?php require "../../admin/models/includes/rootlink.php";
    require "../models/minscription.php";
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
        <title>Yaboïgui | Inscription</title>
        <style>
            label{font-size: 20px;}
            .style{border: 5px solid ;border-radius: 4px;box-shadow: 3px 3px tan;}
            .style:hover{border: 5px ridge blue;border-radius: 5px;box-shadow: 5px -7px magenta;}
            .style:hover strong{border-bottom: 5px solid black;}
            .mdp_oublie{font-size: 18px;font-weight: bold;text-align: center;}
        </style>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container ">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 style admin">
                    <h1 style="text-align:center ;">
                        <strong>Inscription</strong>
                    </h1><br>
                    <form action="" method="POST" class="form">
                        <div class="form-group">
                            <label for="name" class="label-control">Nom : </label>
                            <input type="text" name="nom" id="name" class="form-control input-lg" placeholder="Ex : guilavogui" required>
                            <span class="help-inline"><?php echo $erreurnom;?></span>
                        </div>
                        <div class="form-group">
                            <label for="prenom" class="label-control">Prenom : </label>
                            <input type="text" name="prenom" id="prenom" class="form-control input-lg"placeholder="Ex : foromo pierre" required>
                            <span class="help-inline"><?php echo $erreurprenom;?></span>
                        </div>
                        <div class="form-group">
                            <div class="form-group col-sm-6">
                                <label for="contact" class="label-control">Contact : </label>
                                <input type="tel" name="contact" id="contact" class="form-control input-lg"placeholder="Ex : 621627214" required>
                                <span class="help-inline"><?php echo $erreurcontact;?></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="genre" class="label-control">Genre : </label>
                                <select name="genre" id="genre" class="form-control input-lg">
                                    <option value="m">Homme</option>
                                    <option value="f">Femme</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="label-control">Email : </label>
                            <input type="email" name="email" id="email" class="form-control input-lg"placeholder="Ex : pierreguilao96@gmail.com" required>
                            <span class="help-inline"><?php echo $erreuremail;?></span>
                        </div>
                        <div class="form-group">
                            <label for="login" class="label-control">login : </label>
                            <input type="text" name="login" id="login" class="form-control input-lg">
                            <span class="help-inline"><?php echo $erreurlogin;?></span>
                        </div>

                        <div class="form-group">
                            <label for="mdp" class="label-control">mot de passe : </label>
                            <input type="password" name="mdp" id="mdp" class="form-control input-lg">
                            <span class="help-inline"><?php echo $erreurmdp;?></span>
                        </div>
                        <div class="form-group">
                            <button style="width:100% ;" type="submit" class="btn btn-success btn-lg ">S'inscrire</button>
                        </div>
                        <a href="connexion.php" class="btn mdp_oublie form-control">connexion</a>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>