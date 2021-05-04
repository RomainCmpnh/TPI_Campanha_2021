<?php
require_once 'uc/model/Item.php';
require_once 'commons/views/Html.php';

const PAGE_SIZE = 10;
const ITEM_SEARCH_QUERY = "ItemSearchQuery";

// Le numéro de la page est récupéré en GET, car il est fourni dans la ligne de commande
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
if (empty($page)) {
    $page = 1;
}

// Le mot à rechercher est récupéré en POST, et est sauvé dans la session
// s'il n'existe pas, on le reprend depuis la session
$word = filter_input(INPUT_POST,'word',FILTER_SANITIZE_STRING);
if (is_null($word)){
    $word = Session::get(ITEM_SEARCH_QUERY);
} else {
    Session::set(ITEM_SEARCH_QUERY,$word);
}

// Récupération du nombre total de résultat
// Afin de calculer le nombre de pages à afficher
// Création des données pour le navigateur de pages
$count = Item::SearchCount($word);
$pages = array();
for ($i = 1; $i <= ceil($count / PAGE_SIZE); $i++) {
    $pages[$i] = Routes::PathTo("dico", "searchDefinitions") . "&page=$i";
}

// Récupération des données de la page
$definitions = Item::SearchAllOffsetLimit($word,PAGE_SIZE * ($page - 1), PAGE_SIZE);



Html::showHtmlPage(
    'items',
    "uc/items/views/showDefinitionsByPage.php",
    array(
        'definitions' => $definitions,
        'pages' => $pages,
        'page' => $page,
        'word' => $word,
        'count' => $count
        )
);
