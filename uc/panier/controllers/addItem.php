<?php
require_once 'uc/items/models/Item.php';
require_once 'uc/panier/models/commandItem.php';
require_once 'uc/command/model/command.php';
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

$idCommand = filter_input(INPUT_POST,'idCommand',FILTER_VALIDATE_INT);

$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

$article = Item::findById($id); 
$nameArticle = $article->getName();

$commandItem = new commandItem();

while($commandItem->getIdCommand() == 0) {
if($idCommand == 0){
    $command = new command();
    $user = Session::getUser();
    $userId = $user->getIdUser();


    $date = date("Y-m-d H:i:s");
    $command->setCommandStatus("Basket");
    $command->setCommandDate($date);
    $command->setIdUser($userId);

    $idCommand = command::add($command);

}
else{


$commandItem->setIdCommand($idCommand);
$commandItem->setIdItem($article->getIdItem());
$commandItem->setSalePrice($article->getPrice());
$commandItem->setQuantity($quantity);


// si au terme de la validation, aucune erreur n'a été détectée, alors on peut enregister les données
if (empty($errors)){

        
        $id = commandItem::add($commandItem);
    if (is_int($id)){
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS,"l'article suivant a été enregistrée: <br>$nameArticle");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"l'article $name n'a pas pu être enregistrée, pour une raison qui nous échappe...");
    }
    header("Location:".Routes::PathTo('items','searchItems'));
    exit;
}
}
}