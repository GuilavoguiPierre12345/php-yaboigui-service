<?php
    
    require_once('panier.php');
    require "../../admin/vues/database.php";
    $panier = new panier();

if(isset($_GET['id']))
{
    $db= Database::connect();
    $req = 'SELECT id FROM items WHERE id =:id';
    $produit = $db->prepare($req);
    $produit->execute(array('id'=>$_GET['id']));
    $produit=$produit->fetch();
    if(empty($produit))
    {
        die('Ce produit n\'existe pas ');
    }
    $panier->add($produit['id']);
    die('Le produit a bien été ajouté à votre panier! <a href="javascript:history.back()">retour sur le catalogue</a>');
}
else
{
    die('Vous n\'avez pas sélectionné de produit à ajouter au panier');
}

?>