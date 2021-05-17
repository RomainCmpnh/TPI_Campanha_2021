<?php
 if (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_CUSTOMER ,User::USER_ROLE_PRODUCT_MANAGER, User::USER_ROLE_ANONYMOUS, User::USER_ROLE_BANNED, User::USER_ROLE_NOT_VERIFIED,User::USER_ROLE_SALE_MANAGER, User::USER_ROLE_WEB_MANAGER))){
  Routes::AddRoute("panier", "showPanier", "uc/panier/controllers/showPanier.php");
  $menuItems = new Menu("Panier", null, true, Menu::MENU_MAIN_MENU_LEFT);
  $menuItems->AddItem(new Menu("Consulter le panier", Routes::PathTo("panier", "showPanier")));
} 
if (Session::getUser()->hasCurrentRole(array(User::USER_ROLE_CUSTOMER))) {

   
    // Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    // Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    // Routes::AddRoute("items", "detailItems", "uc/items/controllers/detailItem.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");
    
    Routes::AddRoute("panier", "addItem", "uc/panier/controllers/addItem.php");
    Routes::AddRoute("panier", "deleteItem", "uc/panier/controllers/deleteItem.php");
    Routes::AddRoute("panier", "finaliser", "uc/panier/controllers/finaliserCommande.php");
    Routes::AddRoute("panier", "logoutPanier", "uc/panier/views/PanierLogout.php");

    
    
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
} 