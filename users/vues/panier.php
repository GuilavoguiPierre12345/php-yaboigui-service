<?php
    class panier{
        public function __construct()
        {//on vérifie si la session n'est pas declarée ou est null, alors on ouvre une nouvelle session
            if(!isset($_SESSION))
            {
                session_start();
            }
            // si le panier n'existe pas encore dans la variable session, alors on le crée
            if(!isset($_SESSION['panier']))
            {
                // on crée un tableau panier vide de type tableau
                $_SESSION['panier']= array();
            }
        }

        public function add($produit_id)
        {
            $_SESSION['panier'][$produit_id]=1;
        }
       
        
    }


?>