<?php
// appel du code de la connection à la bd
    require "database.php";

    if(!empty((int)($_GET['id']))){
        $id = checkinput($_GET['id']);
    }

    $db = Database::connect();
    $statement = $db->prepare("SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category
                                FROM items LEFT JOIN categories ON items.category=categories.id
                                WHERE items.id=?");
    $statement->execute(array($id));
    
    $item = $statement->fetch();
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
                    <h1><strong>Voir un element: </strong></h1>
                    <br>
                    <form>
                        <div class="form-group">
                            <label>Nom :</label><?php echo ' '. $item['name'];?>
                        </div>   
                        <div class="form-group">
                            <label>Description :</label><?php echo ' '. $item['description'];?>
                        </div>     
                        <div class="form-group">
                            <label>Prix :</label><?php echo ' '. number_format((float)$item['price'],2,'.',',');?><br>
                        </div> 
                        <div class="form-group">    
                            <label>Categorie :</label><?php echo ' '. $item['category'];?><br>
                        </div>   
                        <div class="form-group"> 
                            <label>Image :</label><?php echo ' '.$item['image'];?><br>
                        </div>  
                    </form>
                    <div class="form-action">
                        <a href="gestion.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                </div>

                <div class="col-sm-6 site">
                    <div class="thumbnail">
                        <img src="<?php echo '../../images/'.$item['image'];?>" alt="Burger">
                        <div class="prix"><?=  number_format((float)$item['price'],2,'.',',') ;?></div>
                        <div class="caption">
                            <h4><?= $item['name'] ;?></h4>
                            <p><?= $item['description'] ;?></p>
                            <a href="#" class="btn btn-order disabled" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> COMMANDEZ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>