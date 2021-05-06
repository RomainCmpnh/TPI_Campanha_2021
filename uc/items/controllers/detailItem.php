<?php
require_once 'commons/views/Html.php';
require_once 'uc/items/models/Item.php';

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$itemSelect = Item::FindById($id);

Html::showHtmlPage('itemSelect', "uc/items/views/showDetailItem.php", array("itemSelect" => $itemSelect));