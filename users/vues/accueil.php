<?php session_start();
     require_once('panier.php');
     
     $panier = new panier();
require "../../admin/models/includes/rootlink.php";?>
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
    <link rel="stylesheet" href="<?php echo $rootlink;?>/css/panier.css">
    <title>Yaboïgui service</title>
    <style>
        .connexion{font-size: 30px;text-align: center;color: green;margin-top: 20px; margin-bottom: 5rem;}
        .badge{border-radius: 10px;background: orange;top: 8px;right: 15px;position: relative;}
    </style>
</head>
<body>
    <div class="container site">
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
            
        </h1>
        <!-- panier -->
        <i class="glyphicon glyphicon-shopping-cart panier-icon" title="ouvrir le panier"></i>
        <div class="panier">
            <div class="entete-panier">
                <h3 class="titre">MON PANIER</h3>
                <!-- bouton de fermeture -->
                <span class="btn-fermer glyphicon glyphicon-remove" title="fermer le panier"></span>
            </div>
            <!-- panier contenu -->
            <div class="contenu-panier">
                <!-- PRODUIT DU PANIER -->
                <div class="produit">
                    <img src="<?php echo $rootlink;?>/images/b1.png" alt="" class="img-produit">
                    <div class="details">
                        <h3 class="nom-produit">Menu </h3>
                        <h4 class="prix-produit">50000GNF</h4>
                        <input type="number" class="qte-produit input-lg">
                    </div>
                    <!-- bouton de suppression -->
                    <i class="glyphicon glyphicon-trash btn-supprimer"></i>
                </div>
                <!-- PRODUIT DU PANIER -->
                <div class="produit">
                    <img src="<?php echo $rootlink;?>/images/b1.png" alt="" class="img-produit">
                    <div class="details">
                        <h3 class="nom-produit"> big</h3>
                        <h4 class="prix-produit">50000GNF</h4>
                        <input type="number" class="qte-produit input-lg">
                    </div>
                    <!-- bouton de suppression -->
                    <i class="glyphicon glyphicon-trash btn-supprimer"></i>
                </div>
                <!-- PRODUIT DU PANIER -->
                <div class="produit">
                    <img src="<?php echo $rootlink;?>/images/b1.png" alt="" class="img-produit">
                    <div class="details">
                        <h3 class="nom-produit">Menu burger</h3>
                        <h4 class="prix-produit">50000GNF</h4>
                        <input type="number" class="qte-produit input-lg">
                    </div>
                    <!-- bouton de suppression -->
                    <i class="glyphicon glyphicon-trash btn-supprimer"></i>
                </div>
                <!-- PRODUIT DU PANIER -->
                <div class="produit">
                    <img src="<?php echo $rootlink;?>/images/b1.png" alt="" class="img-produit">
                    <div class="details">
                        <h3 class="nom-produit">Burger</h3>
                        <h4 class="prix-produit">50000GNF</h4>
                        <input type="number" class="qte-produit input-lg">
                    </div>
                    <!-- bouton de suppression -->
                    <i class="glyphicon glyphicon-trash btn-supprimer"></i>
                </div>
            </div>
            <!-- prit total  -->
            <div class="prix-total">
                <span class="total-titre">TOTAL : </span>
                <span class="total-valeur">10000GNF</span>
            </div>
            
        </div>
        <!-- #panier -->
        <p class="connexion">
            <span style="font-size: 80px;" class="glyphicon glyphicon-user"></span>
            <span class="badge">.</span><?php if($_SESSION['id']) echo strtoupper($_SESSION['loginuser']); ?>
            <a href="mescmds.php" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Mes commandes</a>
        </p>
        <!-- la navigation -->
        <?php 
            require "../../admin/vues/database.php";
            echo '<nav class="navbar">
                    <div class="navbar-header">
                        <span class="navbar-brand">yaboïgui service</span>
                    </div>
                    <ul class="nav navbar-nav">';
                    $db = Database::connect();
                    $statement = $db->query('SELECT * FROM categories');
                    $categories = $statement->fetchAll();
                    foreach($categories as $category){
                        if($category['id']=='1')
                            echo '<li role="presentation" class="active"><a href="#'.$category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>';
                       else
                            echo '<li role="presentation"><a href="#'.$category['id'].'" data-toggle="tab">'.$category['name'].'</a></li>';
                    }
            echo    '</ul>
                  </nav>';
        
            // tab content
            echo '<div class="tab-content">';
            foreach($categories as $category){
                if($category['id']=='1')
                    echo '<div class="tab-pane active" id="'. $category['id'].'">';
                else
                    echo '<div class="tab-pane" id="'. $category['id'].'">';            
                    
                    echo '<div class="row">';

                    $statement = $db->prepare("SELECT * FROM items WHERE items.category = ?");
                    $statement->execute(array($category['id']));

                    
                    while($item = $statement->fetch()){
                        echo '<div class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <img class="image" src="../../images/'.$item['image'].'" alt="Burger">
                                        <div class="prix">gnf'.$item['price'].'</div>
                                        <div class="caption">
                                            <h4 class="name">'.$item['name'].'</h4>
                                            <p>'.$item['description'].'</p>'.
                                            '<a href="mescmds.php?id='.$item['id'].'" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> COMMANDEZ</a>
                                        </div>
                                    </div>
                                </div>';
                    }
                        echo '</div> 
                            </div>';
            }
            Database::disconnect();
            echo '</div>';
        ?>
        </div>
        
        <script src="<?php echo $rootlink;?>/JS/panier.js"></script>
    </body>
</html>