<?php
require_once 'commons/views/Html.php';
require_once 'commons/model/Session.php';
require_once 'uc/panier/models/commandItem.php';


$user = Session::getUser();
$commands = commandItem::getAll($user);

Html::showHtmlPage('panier', "uc/panier/views/showPanier.php", array("commands" => $commands));