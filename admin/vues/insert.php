<?php
    require "../models/includes/rootlink.php";
    require "database.php";
    // initialisation des variables d'erreur et de valeur
    $nameerror = $descriptionerror = $imageerror = $priceerror = $categoryerror = "";
    $name = $description = $price = $category = $image = "";

    if(!empty($_POST)){
        $name               = checkinput($_POST['name']);
        $description        = checkinput($_POST['description']);
        $category           = checkinput($_POST['category']);
        $price              = checkinput($_POST['price']);
        $image              = checkinput($_FILES['image']['name']);
        $imagePath          = '../../images/'.basename($image);
        $imageExtension     = pathinfo($imagePath,PATHINFO_EXTENSION);
        $isSuccess          = true ;    //par défaut le formulaire est rempli
        $isUploadSuccess    = false;    //par défaut aucune image n'a été choisi

        // on vérifie les champs s'ils ne sont pas vide
        if(empty($name)){
            $nameerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($description)){
            $descriptionerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($price)){
            $priceerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($category)){
            $categoryerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }
        if(empty($image)){
            $imageerror = "Ce champs ne peut pas être vide";
            $isSuccess = false;
        }else{
            $isUploadSuccess = true;
            // vérification des extensions valides pour l'image
            if($imageExtension !="jpg" && $imageExtension !="jpeg" && $imageExtension !="png"
                && $imageExtension !="gif" && $imageExtension !="jfif"){
                    $imageerror = "Les fichiers autorises sont: .jpg, .jpeg, .png, .jfif, .gif";
                    $isUploadSuccess = false;

                }
            // vérification de l'existence de l'image
            if(file_exists($imagePath)){
                $imageerror = "L'image existe deja !!";
                $isUploadSuccess = false ; 
            }
            // vérification de la taille de l'image
            if($_FILES['image']["size"] > 500000){
                $imageerror = "La taille de l'image ne doit pas depasser 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess){
                // vérification du chargement de l'image
                if(!move_uploaded_file($_FILES['image']['tmp_name'],$imagePath)){
                    $imageerror = "Il y a une erreur lors du chargement de l'image";
                    $isUploadSuccess = false;
                }
            }
        }
        // la vérification finale pour l'insertion dans la base de donnée
        if($isSuccess && $isUploadSuccess){
            // connection à la base de donnée
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO items (name,description,price,image,category) 
            VALUES(?,?,?,?,?)");
            $statement->execute(array($name,$description,$price,$image,$category));
            Database::disconnect();
            header('Location:gestion.php');
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
        <title>yaboïgui | afficher </title>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h1><strong>Ajouter un element: </strong></h1>
                    <br>
                    <form role="form" class="form" action="insert.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="label-control">Nom :</label>
                            <input class="input-lg form-control" type="text" name="name" placeholder="nom element" value="<?= $name ;?>">
                            <span class="help-inline"><?php echo $nameerror ;?></span>
                        </div>   
                        <div class="form-group">
                            <label class="label-control">Description :</label>
                            <input class="input-lg form-control" type="text" name="description" placeholder="description" value="<?= $description ;?>">
                            <span class="help-inline"><?php echo $descriptionerror ;?></span>
                        </div> 
                             
                        <div class="form-group">
                            <label class="label-control">Prix  :</label>
                            <input class="form-control input-lg" type="number" name="price" step="0.10" min=1 placeholder="prix element" value="<?= $price ;?>">
                            <span class="help-inline"><?php echo $priceerror ;?></span>
                        </div>  
                        <div class="form-group">
                            <label class="label-control">Category :</label>
                            <select name="category" id="category" class="form-control">
                                <?php $db=Database::connect();
                                    foreach($db->query("SELECT * FROM categories") as $row){
                                        echo '<option class="input-lg form-control" value=" ' .$row['id']. '">' . $row['name'] .'</option>';
                                    }
                                    Database::disconnect();
                                 ?>
                            </select>
                            <span class="help-inline"><?php echo $categoryerror ;?></span>
                        </div> 
                        <div class="form-group">
                            <label class="label-control">Selectioner une image :</label>
                            <input type="file" class="form-control input-lg" name="image">
                            <span class="help-inline"><?php echo $imageerror ;?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                            <a href="gestion.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>