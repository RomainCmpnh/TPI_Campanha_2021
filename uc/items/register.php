<?php

if (!Session::getUser()->isAnonymous() && !Session::getUser()->hasCurrentRole(User::USER_ROLE_BANNED)) {

    Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    Routes::AddRoute("items", "detailItems", "uc/items/controllers/detailItem.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");

    $menuItems = new Menu("Items", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Afficher les Items", Routes::PathTo("items", "showItems")));
    $menuItems->AddItem(new Menu("Rechercher dans les Items", Routes::PathTo('items','searchItems')));
   // $menuMessages->AddItem(new Menu("Envoyer un message", Routes::PathTo("messages", "sendMessages")));

    if (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_PRODUCT_MANAGER,User::USER_ROLE_SALE_MANAGER))) {
        Routes::AddRoute("items", "deleteItems", "uc/items/controllers/deleteItems.php");
        Routes::AddRoute("items", "editItem", "uc/items/controllers/editItem.php");
        Routes::AddRoute("items", "saveItem", "uc/items/controllers/saveItem.php");

        $menuItems->AddDivider();
        $menuItems->AddItem(new Menu("Ajouter un article", Routes::PathTo('items','editItem')));
    } else {
        Routes::AddRoute("items", "deleteItems", 'commons/controllers/accessDenied.php');
        Routes::AddRoute("items", "editItem", 'commons/controllers/accessDenied.php');
        Routes::AddRoute("items", "saveItem", 'commons/controllers/accessDenied.php');
    }
} else {
    Routes::AddRoute("items", "showItems", 'commons/controllers/accessDenied.php');
    //Routes::AddRoute("items", "sendMessages", 'commons/controllers/accessDenied.php');
}
