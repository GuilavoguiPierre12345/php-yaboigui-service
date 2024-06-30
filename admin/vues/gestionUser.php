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
                    <strong>Liste des Utilisateurs : </strong>
                    <a href="insert.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>
                    <a href="pageAdmin.php" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </h1>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>prenom</th>
                            <th>Genre</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require "database.php";
                            $db = Database::connect();
                            $statement = $db->query("SELECT users.id, users.nom, users.prenom, users.sexe, users.contact,users.email,users.login
                                            FROM users ORDER BY users.id DESC");
                                            
                            $nbrElement = $statement->rowCount();
                            while($user = $statement->fetch()){
                                echo '<tr>';
                                    echo '<td>'.$user['nom'].'</td>';
                                    echo '<td>'.$user['prenom'].'</td>';
                                    echo '<td>'.$user['sexe'].'</td>';
                                    echo '<td>'.$user['contact'].'</td>';
                                    echo '<td>'.$user['email'].'</td>';
                                    echo '<td>'.$user['login'].'</td>';
                                    echo '<td style="width: 300px;">';
                                        echo '<a href="viewUser.php?id='.$user['id'].'" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                                        echo '<a href="updateUser.php?id='.$user['id'].'" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                                        echo '<a href="deleteUser.php?id='.$user['id'].'" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                            // deconnection à la base 
                            Database::disconnect();
                        ?>
                    </tbody>
                    <tfoot>
                        <p class="input-lg" style="font-size:26px;">Nombre d'Users : <?php echo $nbrElement;?></p>
                    </tfoot>
                </table>
            </div>
        </div>
    </body>
</html>