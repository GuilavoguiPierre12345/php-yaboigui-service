<?php require "admin/models/includes/rootlink.php";?>
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
        <title>Yaboïgui service</title>
        <style>
            footer{color: white; border-top: 5px solid white;}
            .service,.contacter,.apropos{border-left: 2px solid white; border-right: 2px solid white;}
            .service>h3,.apropos>h3,.contacter>h3{margin-bottom: 20px;}
            .service>ul>li::before{content: "✔";}
            .contacter>a>img{width: 60px;height: 60px; margin: 4px;}
        </style>
    </head>
    <body>
        <div class="container site">
            <h1 class="text-logo">
                <span class="glyphicon glyphicon-cutlery"></span>bienvenue sur le site yaboïgui service
                <span class="glyphicon glyphicon-cutlery"></span>
            </h1>
            <div class="row">
                <p class="img-thumbnail h2">Nous vous offrons du bon goût</p>
                <p class="img-thumbnail h2">S'inscrire pour profiter de nos services</p>
                <div class="form-group col-sm-4 col-sm-offset-3">
                    <a href="users/vues/inscription.php" class="btn btn-primary input-lg"><span class="glyphicon glyphicon-user"></span> S'inscrire</a>
                    <a href="users/vues/connexion.php" class="btn btn-primary input-lg"><span class="glyphicon glyphicon-user"></span> Se connecter</a>
                </div>
            </div>
        </div>    
        <div class="container-fluid">
            <div class="row ">
                <img src="<?php echo $rootlink;?>/images/d4.png" class="img img-responsive col-sm-4" alt="">
                <img src="<?php echo $rootlink;?>/images/sa5.png" class="img img-responsive col-sm-4" alt="">
                <img src="<?php echo $rootlink;?>/images/s5.png" class="img img-responsive col-sm-4" alt="">

                <img src="<?php echo $rootlink;?>/images/d2.png" class="img img-responsive col-sm-4" alt="">
                <img src="<?php echo $rootlink;?>/images/m2.png" class="img img-responsive col-sm-4" alt="">
                <img src="<?php echo $rootlink;?>/images/s1.png" class="img img-responsive col-sm-4" alt="">
            </div>
        </div>
        
        <footer class="footer container-fluid">
            <div class="row">
                <div class="col-sm-4 text-center service">
                    <h3 class="h3">Nos services</h3><hr width="100" style="height: 10px;">
                    <ul class="list-unstyled">
                        <li class="h3"> Vente de denrée alimentaire</li>
                        <li class="h3"> Livraison des denrée à domicile</li>
                        <li class="h3"> Formation pour la fabrication des plats</li>
                        
                    </ul>
                </div>
                <div class="col-sm-4 text-center contacter">
                    <h3 class="h3">Nous contacter</h3><hr width="100" style="height: 10px;">
                    <a href=""><img src="bootstrap/icons/facebook.svg" alt=""></a>
                    <a href=""><img src="bootstrap/icons/whatsapp.svg" alt=""></a>
                    <a href=""><img src="bootstrap/icons/envelope-fill.svg" alt=""></a>
                    <a href=""><img src="bootstrap/icons/linkedin.svg" alt=""></a>
                    <a href=""><img src="bootstrap/icons/youtube.svg" alt=""></a>
                    <a href=""><img src="bootstrap/icons/telegram.svg" alt=""></a>
                </div>
                <div class="col-sm-4 text-center apropos">
                    <h3 class="h3">Qui nous sommes ?</h3><hr width="100" style="height:10px ;">
                </div>
            </div>
        </footer>
    </body>
</html>