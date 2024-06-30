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
        <div class="container admin">
            <div class="row">
                <h1>
                    <strong>Liste des elements: </strong>
                    <a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>
                    <a href="pageAdmin.php" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </h1>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Catégories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require "database.php";
                            $db = Database::connect();
                            $statement = $db->query("SELECT items.id, items.name, items.description, items.price, categories.name AS category
                                            FROM items LEFT JOIN categories ON items.category=categories.id
                                            ORDER BY items.id DESC");
                            $nbrElement = $statement->rowCount();
                            while($item = $statement->fetch()){
                                echo '<tr>';
                                    echo '<td>'.$item['name'].'</td>';
                                    echo '<td>'.$item['description'].'</td>';
                                    echo '<td>'.number_format($item['price'],2,'.',',') .'</td>';
                                    echo '<td>'.$item['category'].'</td>';
                                    echo '<td style="width: 300px;">';
                                        echo '<a href="view.php?id='.$item['id'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                        echo '<a href="update.php?id='.$item['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                        echo '<a href="delete.php?id='.$item['id'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                            // deconnection à la base 
                            Database::disconnect();
                        ?>
                    </tbody>
                    <tfoot>
                        <p class="input-lg" style="font-size:26px;">Nombre d'element : <?php echo $nbrElement;?></p>
                    </tfoot>
                </table>
            </div>
        </div>
    </body>
</html>