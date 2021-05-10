<?php

require_once 'uc/items/models/Item.php';
require_once 'commons/views/Html.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (is_int($id)) {
$itemSelect = Item::FindById($id);
} else {
    $itemSelect = new Item();
}
$mode = (empty($itemSelect->getIdItem())) ? 'Ajouter' : 'Modifier';



Html::showHtmlPage(
    "$mode un article",
    "uc/items/views/formItem.php",
    array(
        'itemSelect' => $itemSelect,
        'mode' => $mode,
    )
);
