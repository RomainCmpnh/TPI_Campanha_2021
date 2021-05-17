<?php

require_once 'uc/command/model/command.php';
require_once 'commons/views/Html.php';


$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (is_int($id)) {
    $command = command::findById($id);
    if ($command === null) {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_WARNING, "La commande avec l'id $id n'a pas été trouvée... impossible de le supprimer.");
    } elseif (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_SALE_MANAGER,User::USER_ROLE_CUSTOMER ))) {
        $nb = command::DeleteBarket($command);
        $nb = command::Delete($command);
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS, "La commande a été supprimée");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER, "Vous ne disposez pas de droits suffisants pour supprimer ce message");
    }
}

if (Session::getUser()->hasCurrentRole(User::USER_ROLE_SALE_MANAGER)) {
header("Location:" . Routes::PathTo('command', 'showCommandManager'));
} else if (Session::getUser()->hasCurrentRole(User::USER_ROLE_SALE_MANAGER)) {
    header("Location:" . Routes::PathTo('command', 'showCommandCustomer'));
}