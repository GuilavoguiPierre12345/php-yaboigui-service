<?php 
    require "../../admin/vues/database.php";

    // initialisation des variables d'erreurs
    $erreurcontact = $erreuremail = "";

    
    /**cette fonction est écrite pour pouvoir éviter les failles xss */
    function checkinput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>