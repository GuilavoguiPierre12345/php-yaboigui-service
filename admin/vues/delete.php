<?php
    require "../models/includes/rootlink.php";
    require "database.php";
    
    if(!empty($_GET['id'])){
        $id = (int)(checkinput($_GET['id']));
    }

    if(!empty($_POST)){
        $id = $_POST['id'];
        $db = Database::connect();
        $statement =$db->prepare("DELETE FROM items WHERE id=?"); 
        $statement->execute(array($id));
        header('Location:gestion.php');
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
        <title>yaboïgui | supprimer element </title>
    </head>
    <body>
        <h1 class="text-logo">
            <span class="glyphicon glyphicon-cutlery"></span>yaboïgui service
            <span class="glyphicon glyphicon-cutlery"></span>
        </h1>
        <div class="container admin">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <h1><strong>Supprimer un element: </strong></h1>
                    <br>
                    <form role="form" class="form" action="" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger"> Oui</button>
                            <a href="gestion.php" class="btn btn-default"> Non</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>