<?php 
require_once 'commons/views/Html.php';
?>

<div class="d-flex flex-row justify-content-between">
<?php
if(Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)){
   echo"<h1>Ajouter un article au panier afin de creer votre panier</h1>";
} else
         if(Session::getUser()->hasCurrentRole(User::USER_ROLE_ANONYMOUS)){
            echo"<h1>Veuillez vous identifier afin de bénéficier de cette fonctionnalitée</h1>";
        } else
            if(Session::getUser()->hasCurrentRole(User::USER_ROLE_NOT_VERIFIED)){
                echo"<h1>La vérification de votre email est en cours,tant que cela n’est pas finalisé, impossible d’effectuer des achats</h1>";
            } else if(Session::getUser()->hasCurrentRole(User::USER_ROLE_BANNED)){
                echo"<h1>Vous êtes bannis, vous n'avez donc pas accès a cette fonctionnalitée</h1>";
            }else if(Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_SALE_MANAGER, User::USER_ROLE_PRODUCT_MANAGER))){
                echo"<h1>Ceci est une fonctionnalitée client</h1>";
            }
            else {
            echo"<h1>Le panier est vide , ajouter un article pour creer votre panier</h1>";  
        }
    ?>
</div>