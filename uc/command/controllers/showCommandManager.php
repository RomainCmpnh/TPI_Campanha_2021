<?php
require_once 'commons/views/Html.php';
require_once 'commons/model/Session.php';
require_once 'uc/command/model/command.php';


$user = Session::getUser();
$commands = command::getAllManager();

Html::showHtmlPage('showCommandCustomer', "uc/command/views/showCommandManager.php", array("commands" => $commands));