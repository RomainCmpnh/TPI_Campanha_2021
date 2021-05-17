<?php
require_once 'commons/views/Html.php';
require_once 'commons/model/Session.php';
require_once 'uc/panier/models/commandItem.php';


$user = Session::getUser();

$commands = commandItem::getAll($user);


if(empty($commands)){
    Html::showHtmlPage('panier', "uc/panier/views/emptyPanier.php",array("commands" => $commands, "users" => $user));
}
else{
    $count = commandItem::CountTotal($user);
    Html::showHtmlPage('panier', "uc/panier/views/showPanier.php", array("commands" => $commands, "count" => $count,"users" => $user ));
}
