<?php

require_once 'uc/items/models/Item.php';
require_once 'commons/views/Html.php';

if (!Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER))) {
    FlashMessage::AddMessage(
        FlashMessage::FLASH_RANKING_DANGER,
        "Vous ne disposez pas de droits suffisants pour supprimer un article"
    );
    header("Location:" . Routes::PathTo('items', 'showItems'));
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (is_int($id)) {
    $item = Item::findById($id);
    if ($item === null) {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_WARNING, "L'article avec l'id $id n'a pas été trouvée... impossible de le supprimer.");
    } elseif (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER)) {
        $nb = Item::Delete($item);
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS, "L'article " . $item->getName() . " a été supprimée");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER, "Vous ne disposez pas de droits suffisants pour supprimer ce message ($id)");
    }
}

header("Location:" . Routes::PathTo('items', 'showItems'));