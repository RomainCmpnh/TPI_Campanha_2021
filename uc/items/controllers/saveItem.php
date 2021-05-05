<?php
require_once 'uc/items/model/Item.php';
require_once 'commons/views/Html.php';

// seuls les managers peuvent accéder à ce contrôleur.
if (!Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_PRODUCT_MANAGER,User::USER_ROLE_SALE_MANAGER))) {
    FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"Vous ne disposez pas de droits suffisants pour éditer un article");
    header("Location:".Routes::PathTo('items','listItems'));
    exit;
}


$errors = array();

// récupérer les données du formulaire
$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$word = trim(filter_input(INPUT_POST,'word',FILTER_SANITIZE_STRING));
$item = trim(filter_input(INPUT_POST,'item',FILTER_SANITIZE_STRING));

// Si l'utilisateur courant est le WebManager, on récupère l'id de l'auteur depuis le formulaire
// sinon, on le prend dans la session
if (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER)) {
    $idOwner = filter_input(INPUT_POST,'idOwner',FILTER_VALIDATE_INT);
} else {
    $idOwner = Session::getUser()->getIdUser();
}

// valider les données du formulaire
if (empty($word)){
    $errors['word'] = "Le mot à définir ne peut pas être vide";
}
if (empty($item)){
    $errors['item'] = "L'article du mot ne peut pas être vide";
}
if (is_int($idOwner)) {
    if (User::findById($idOwner)===null){
        $errors['idOwner'] = "L'id de l'auteur n'est pas valide";
        $idOwner = null;
    }
} else {
    $idOwner = null;
}
if(!is_int($id)) { $id = null;}

$article = new Item();
// $article->setId($id)->setWord($word)->setDefinition($definition)->setIdOwner($idOwner);


// si au terme de la validation, aucune erreur n'a été détectée, alors on peut enregister les données
if (empty($errors)){
    if ($id===null) {
    //    $id = Item::add($def);
    } else {
      //  $id = Item::update($def);
    }
    if (is_int($id)){
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS,"la définition suivante a été enregistrée: <br>$word : $definition");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"la définition de $word n'a pas pu être enregistrée, pour une raison qui nous échappe...");
    }
    header("Location:".Routes::PathTo('dico','listDefinitions'));
    exit;
}

// Les données contiennent des erreurs, on repart sur le formulaire.
if (is_int($id)){
    $mode = 'Modifier';
} else {
    $mode = 'Ajouter';
}

$users = User::getAllUsersNames();

Html::showHtmlPage("$mode une définition","uc/dico/views/formDefinition.php",
    array(
        'definition'=>$def,
        'mode'=>$mode,
        'users'=>$users,
        'errors' => $errors
));