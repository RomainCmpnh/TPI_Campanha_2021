<?php

if (Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)) {

    // Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    // Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    // Routes::AddRoute("items", "detailItems", "uc/items/controllers/detailItem.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");
    Routes::AddRoute("panier", "showPanier", "uc/panier/controllers/showPanier.php");
    Routes::AddRoute("panier", "addItem", "uc/panier/controllers/addItem.php");
    Routes::AddRoute("panier", "pdfPanier", "uc/panier/views/pdfPanier.php");

    
    $menuItems = new Menu("Panier", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Consulter le panier", Routes::PathTo("panier", "showPanier")));

    
   // if (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_PRODUCT_MANAGER,User::USER_ROLE_SALE_MANAGER))) {
     //   Routes::AddRoute("items", "deleteItems", "uc/items/controllers/deleteItems.php");
       // Routes::AddRoute("items", "editItem", "uc/items/controllers/editItem.php");
       // Routes::AddRoute("items", "saveItem", "uc/items/controllers/saveItem.php");

       // $menuItems->AddDivider();
       // $menuItems->AddItem(new Menu("Ajouter un article", Routes::PathTo('items','editItem')));
   // } else {
     //   Routes::AddRoute("items", "deleteItems", 'commons/controllers/accessDenied.php');
       // Routes::AddRoute("items", "editItem", 'commons/controllers/accessDenied.php');
       // Routes::AddRoute("items", "saveItem", 'commons/controllers/accessDenied.php');
    //}
} else {
    Routes::AddRoute("panier", "showPanier", 'commons/controllers/accessDenied.php');
  //  Routes::AddRoute("items", "sendMessages", 'commons/controllers/accessDenied.php');
}