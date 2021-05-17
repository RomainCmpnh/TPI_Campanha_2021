<?php
// Projet: Application TPI
// Script: Contrôleur generatePDF.php
// Description: Récupère l'id de la livraison séléctionnée
// Version 1.0.0 PC 06.05.2021 / Codage initial

require_once 'uc/command/model/command.php';
require_once 'uc/items/models/item.php';
require_once 'uc/panier/models/commandItem.php';
require_once 'commons/views/Html.php';



$idCommand = filter_input(INPUT_POST, "idCommand", FILTER_VALIDATE_INT);

// Sauvegarder les variables dans la session
if (!isset($_SESSION['idCommand'])) {
    $_SESSION['idCommand'] = $idCommand;

}
else {

    $_SESSION['idCommand'] = $idCommand;

}

header("location:" . Routes::PathTo("command", "executePDF"));
exit;