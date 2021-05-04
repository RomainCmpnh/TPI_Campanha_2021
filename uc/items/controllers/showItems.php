<?php

require_once 'commons/views/Html.php';
require_once 'uc/items/models/Item.php';

$items = Item::getAll();

Html::showHtmlPage('items', "uc/items/views/showItems.php", array("items" => $items));