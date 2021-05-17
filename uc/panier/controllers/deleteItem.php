<?php

require_once 'uc/panier/models/commandItem.php';
require_once 'commons/views/Html.php';
require_once 'uc/command/model/command.php';

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$idCommand = filter_input(INPUT_POST, 'idCommand', FILTER_VALIDATE_INT);
if (is_int($id)) {
    $command = command::FindById($idCommand);
    $commandItem = commandItem::FindByCommandId($idCommand);

    if ($command === null) {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_WARNING, "L'article avec l'id $idCommand n'a pas été trouvée... impossible de le supprimer.");
    } elseif (Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)) {
        $nb = command::DeleteBarket($command);
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS, "L'article a été supprimée");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER, "Vous ne disposez pas de droits suffisants pour supprimer ce message ($idCommand)");
    }
}

header("Location:" . Routes::PathTo('panier', 'showPanier'));