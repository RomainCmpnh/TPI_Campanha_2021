<?php
if (Session::getUser()->hasCurrentRole(User::USER_ROLE_CUSTOMER)) {

    // Routes::AddRoute("items", "showItems", "uc/items/controllers/showItems.php");
    // Routes::AddRoute("items", "searchItems", "uc/items/controllers/searchItems.php");
    // Routes::AddRoute("items", "detailItems", "uc/items/controllers/detailItem.php");
    //Routes::AddRoute("items", "sendMessages", "uc/messages/controllers/sendMessages.php");
    Routes::AddRoute("command", "showCommandCustomer", "uc/command/controllers/showCommandCustomer.php");
    Routes::AddRoute("command", "pdfPanier", "uc/command/controllers/generatePDF.php");
    Routes::AddRoute("command", "executePDF", "uc/command/controllers/executePDF.php");
    $menuItems = new Menu("Commandes", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Consulter mes commandes", Routes::PathTo("command", "showCommandCustomer")));
    

}else if(Session::getUser()->hasCurrentRole(User::USER_ROLE_SALE_MANAGER)){
    Routes::AddRoute("command", "showCommandManager", "uc/command/controllers/showCommandManager.php");
    Routes::AddRoute("command", "deleteCommand", "uc/command/controllers/deleteCommand.php");

    $menuItems = new Menu("Commandes", null, true, Menu::MENU_MAIN_MENU_LEFT);
    $menuItems->AddItem(new Menu("Consulter les commandes", Routes::PathTo("command", "showCommandManager")));
} else {
    Routes::AddRoute("command", "showCommandCustomer", 'commons/controllers/accessDenied.php');
  //  Routes::AddRoute("items", "sendMessages", 'commons/controllers/accessDenied.php');
}