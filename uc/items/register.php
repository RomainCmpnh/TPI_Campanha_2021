<?php

if (!Session::getUser()->isAnonymous() && !Session::getUser()->hasCurrentRole(User::USER_ROLE_BANNED)) {

    Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");

    $menuItems = new Menu("Items", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Afficher les Items", Routes::PathTo("items", "showItems")));
    $menuItems->AddItem(new Menu("Rechercher dans les Items", Routes::PathTo('items','searchItems')));
   // $menuMessages->AddItem(new Menu("Envoyer un message", Routes::PathTo("messages", "sendMessages")));

    if (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER)) {
        Routes::AddRoute("items", "deleteItems", "uc/items/controllers/deleteItem.php");
    } else {
        Routes::AddRoute("items", "deleteItems", 'commons/controllers/accessDenied.php');
    }
} else {
    Routes::AddRoute("items", "showItems", 'commons/controllers/accessDenied.php');
    //Routes::AddRoute("items", "sendMessages", 'commons/controllers/accessDenied.php');
}
