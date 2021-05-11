<?php
require_once 'uc/items/models/Item.php';
require_once 'uc/panier/models/command.php';
require_once 'uc/panier/models/commandItem.php';
require_once 'commons/views/Html.php';

// seuls les clients peuvent accéder à ce contrôleur.
if (!Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)) {
    FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"Vous ne disposez pas de droits suffisants pour ajouter un article");
    header("Location:".Routes::PathTo('items','showItems'));
    exit;
}


$errors = array();

// récupérer les données du formulaire
$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);

$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

$article = Item::findById($id); 

$command = new command();
$user = Session::getUser();
$userId = $user->getIdUser();

$nameArticle = $article->getName();
$date = date("Y-m-d H:i:s");
$command->setIdCommand($id);
$command->setCommandStatus("Basket");
$command->setCommandDate($date);
$command->setIdUser($userId);
$idCommand= $command->getIdCommand();

$commandItem = new commandItem();

$commandItem->setIdCommand($idCommand);
$commandItem->setIdItem($article->getIdItem());
$commandItem->setSalePrice($article->getPrice());
$commandItem->setQuantity($quantity);


// si au terme de la validation, aucune erreur n'a été détectée, alors on peut enregister les données
if (empty($errors)){

        $id = command::add($command);
        $id = commandItem::add($commandItem);
    if (is_int($id)){
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS,"l'article suivant a été enregistrée: <br>$nameArticle");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"l'article $name n'a pas pu être enregistrée, pour une raison qui nous échappe...");
    }
    header("Location:".Routes::PathTo('items','searchItems'));
    exit;
}
