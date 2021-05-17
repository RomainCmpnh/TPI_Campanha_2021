<?php

if (!Session::getUser()->isAnonymous() && !Session::getUser()->hasCurrentRole(User::USER_ROLE_BANNED)) {

    Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    Routes::AddRoute("items", "searchItemsOrderbyName", "uc/items/controllers/searchItemsOrderbyName.php");
    Routes::AddRoute("items", "searchItemsOrderbyDescendingNumber", "uc/items/controllers/searchItemsOrderbyDescendingNumber.php");
    Routes::AddRoute("items", "searchItemsOrderbyAscendingNumber", "uc/items/controllers/searchItemsOrderbyAscendingNumber.php");
    Routes::AddRoute("items", "searchItemsNoPublished", "uc/items/controllers/searchItemsNoPublished.php");
    Routes::AddRoute("items", "detailItems", "uc/items/controllers/detailItem.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");

    $menuItems = new Menu("Items", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Afficher les Items", Routes::PathTo("items", "showItems")));
  
   // $menuMessages->AddItem(new Menu("Envoyer un message", Routes::PathTo("messages", "sendMessages")));

    $sm = new Menu("Liste des articles",Routes::PathTo('items','searchItems'));
    $menuItems->AddItem($sm);
    $sm->AddItem(new Menu("Recherche par défaut", Routes::PathTo('items','searchItems')));
    $sm->AddItem(new Menu("Recherche triée par nom",Routes::PathTo('items','searchItemsOrderbyName')));
    $sm->AddItem(new Menu("Recherche triée par prix croissant",Routes::PathTo('items','searchItemsOrderbyAscendingNumber')));
    $sm->AddItem(new Menu("Recherche triée par prix decroissant",Routes::PathTo('items','searchItemsOrderbyDescendingNumber')));

    if (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_PRODUCT_MANAGER,User::USER_ROLE_SALE_MANAGER))) {

      //  $sm->AddItem(new Menu("Recherche articles non publié",Routes::PathTo('items','searchItemsNoPublished')));
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