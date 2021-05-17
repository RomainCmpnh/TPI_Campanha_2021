<?php
require_once 'uc/items/models/Item.php';
require_once 'commons/views/Html.php';

// seuls les managers peuvent accéder à ce contrôleur.
if (!Session::getUser()->hasCurrentRole(array(User::USER_ROLE_WEB_MANAGER,User::USER_ROLE_PRODUCT_MANAGER,User::USER_ROLE_SALE_MANAGER))) {
    FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"Vous ne disposez pas de droits suffisants pour éditer un article");
    header("Location:".Routes::PathTo('items','showItems'));
    exit;
}


$errors = array();

// récupérer les données du formulaire
$id = filter_input(INPUT_POST,'id',FILTER_VALIDATE_INT);
$name = trim(filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING));
$description = trim(filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING));
$price = trim(filter_input(INPUT_POST,'price',FILTER_VALIDATE_INT));
$manufacturer = trim(filter_input(INPUT_POST,'manufacturer',FILTER_SANITIZE_STRING));
$serialNumber = trim(filter_input(INPUT_POST,'serialNumber',FILTER_SANITIZE_STRING));
$published = trim(filter_input(INPUT_POST,'published',FILTER_VALIDATE_INT));
$IdCategorie = trim(filter_input(INPUT_POST,'categorie',FILTER_VALIDATE_INT));

// // Si l'utilisateur courant est le WebManager, on récupère l'id de l'auteur depuis le formulaire
// // sinon, on le prend dans la session
// if (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER)) {
//     $idOwner = filter_input(INPUT_POST,'idOwner',FILTER_VALIDATE_INT);
// } else {
//     $idOwner = Session::getUser()->getIdUser();
// }

// valider les données du formulaire
if (empty($name)){
    $errors['name'] = "Le nom à définir ne peut pas être vide";
}
if (empty($description)){
    $errors['description'] = "La description à définir ne peut pas être vide";
}
if (empty($price)){
    $errors['price'] = "Le prix ne peut pas être validé";
}
if (empty($manufacturer)){
    $errors['manufacturer'] = "La marque de l'article ne peut pas être vide";
}
if (empty($serialNumber)){
    $errors['serialNumber'] = "Le numéro de série ne peut pas être vide";
}
if (empty($published)){
    $errors['published'] = "L'article est-il publié ?";
}
if (empty($IdCategorie)){
    $errors['categorie'] = "Saisir la catégorie de l'article";
}
// if (is_int($idOwner)) {
//     if (User::findById($idOwner)===null){
//         $errors['idOwner'] = "L'id de l'auteur n'est pas valide";
//         $idOwner = null;
//     }
// } else {
//     $idOwner = null;
// }
if(!is_int($id)) { $id = null;}

$article = new Item();
//$article->setIdItem($id)->setName($name)->setDescription($description)
//->setPrice($price)->setManufacturer($manufacturer)
//->setPartNumber($$serialNumber)->setPublished($published)
//->setIdCategory($IdCategorie);
$article->setIdItem($id);
$article->setName($name);
$article->setDescription($description);
$article->setPrice($price);
$article->setManufacturer($manufacturer);
$article->setPartNumber($serialNumber);
$article->setPublished($published);
$article->setIdCategory($IdCategorie);

// si au terme de la validation, aucune erreur n'a été détectée, alors on peut enregister les données
if (empty($errors)){
    if ($id==null) {
        $id = Item::add($article);
    } else {
        $id = Item::update($article);
    }
    if (is_int($id)){
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_SUCCESS,"l'article suivant a été enregistrée: <br>$name");
    } else {
        FlashMessage::AddMessage(FlashMessage::FLASH_RANKING_DANGER,"l'article $name n'a pas pu être enregistrée, pour une raison qui nous échappe...");
    }
    header("Location:".Routes::PathTo('items','showItems'));
    exit;
}

// Les données contiennent des erreurs, on repart sur le formulaire.
if (is_int($id)){
    $mode = 'Modifier';
} else {
    $mode = 'Ajouter';
}



Html::showHtmlPage("$mode un article","uc/items/views/formItem.php",
    array(
        'item'=>$article,
        'mode'=>$mode,
        'errors' => $errors
));