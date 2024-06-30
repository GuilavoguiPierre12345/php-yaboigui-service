<?php
    session_start();
    require "../models/includes/rootlink.php";
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
        <title>yaboïgui service</title>
        <style>
            body{color: white;}
            .connexion{
                font-size: 30px;
                text-align: center;
                margin-top: 20px;
                color: green;
            }
            .badge{
                border-radius: 10px;
                background: orange;
                position: relative;
                right: 15px;
                top: 8px;
            }
            td{padding: 15px;}
        </style>
    </head>
    <body>
        <p class="connexion">
            <span style="font-size: 80px;" class="glyphicon glyphicon-user"></span>
            <span class="badge">.</span><?php echo strtoupper($_SESSION['login']); ?>
        </p>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container">
            <div class="row">
                <h1 class="text-center">
                    <strong class="h1">Administration</strong>
                </h1>
                <table>
                    <tr><td class="h1 text-center">Gestion des Users :</td><td><a href="gestionUser.php" class="btn btn-default"><span style="width: 100px;" class="glyphicon glyphicon-arrow-right"></span></a></td></tr>
                    <tr><td class="h1 text-center">Gestion des Marchandises :</td><td><a href="gestion.php" class="btn btn-default"><span style="width: 100px;" class="glyphicon glyphicon-arrow-right"></span></a></td></tr>
                </table>
            </div>
        </div>
    </body>
</html>