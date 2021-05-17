<?php

require_once 'uc/panier/models/commandItem.php';
require_once 'commons/views/Html.php';
require_once 'uc/command/model/command.php';
$today = date("Y-m-d H:i:s");
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$idCommand = filter_input(INPUT_POST, 'idCommand', FILTER_VALIDATE_INT);
if (is_int($id)) {
    $command = command::FindById($idCommand);
    $commandItem = commandItem::FindByCommandId($idCommand);

    if ($command === null) {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_WARNING, "L'article avec l'id $idCommand n'a pas été trouvée...");
    } elseif (Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)) {
        $command->setCommandStatus("Sent");
        $command->setCommandDate($today);

        $nb = command::Add($command);
        $nb = command::DeleteBarket($command);

        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS, "La commande à été envoyée");
    } else {
        
    }
}

header("Location:" . Routes::PathTo('panier', 'showPanier'));