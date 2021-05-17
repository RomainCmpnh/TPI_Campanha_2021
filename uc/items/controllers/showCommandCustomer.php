<?php
require_once 'commons/views/Html.php';
require_once 'commons/model/Session.php';
require_once 'uc/command/model/command.php';
require_once 'uc/panier/models/commandItem.php';

$user = Session::getUser();
$commands = command::getAllCustomer($user);
$commandItem = commandItem::getAll($user);

Html::showHtmlPage('showCommandCustomer', "uc/command/views/showCommandCustomer.php", array("commands" => $commands , "commandItem" => $commandItem));