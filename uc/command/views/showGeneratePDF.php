<?php 
$user = Session::getUser();
require_once 'uc/command/model/command.php';
require_once 'uc/items/models/item.php';
require_once 'uc/panier/models/commandItem.php';

$idCommand = $_SESSION['idCommand'];

$command = command::FindById($idCommand);
?>
<style type="text/css">
<!--
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
-->
</style>
<page backcolor="#FEFEFE" backimg="./res/bas_page.png" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;time;page" style="font-size: 12pt">
    <bookmark title="Lettre" level="0" ></bookmark>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px">
        <tr>
            <td style="width: 75%;">
            </td>
            <td style="width: 25%; color: #444444;">
               
                RELATION CLIENT
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Client :</td>
            <td style="width:36%"> <?= $user->getFirstName()  . " " . $user->getLastName() ?></td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Adresse :</td>
            <td style="width:36%">
                <?= $user->getAddress() ?><br>
                
            </td>
        </tr>
        <tr>
            <td style="width:50%;"></td>
            <td style="width:14%; ">Email :</td>
            <td style="width:36%"><?= $user->getEmail() ?></td>
        </tr>
    </table>
    <br>
    <br>
    <table cellspacing="0" style="width: 100%; text-align: left;font-size: 10pt">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%; ">Spipu Ville, le <?php echo date('d/m/Y'); ?></td>
        </tr>
    </table>
    <br>
    <i>
    
    </i>
    <br>
    <br>
    Madame, Monsieur, Cher Client,<br>
    <br>
    <br>
    Voici votre commande
    <br>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; font-size: 10pt;">
        <colgroup>
            <col style="width: 12%; text-align: left">
            <col style="width: 52%; text-align: left">
            <col style="width: 13%; text-align: right">
            <col style="width: 10%; text-align: center">
            <col style="width: 13%; text-align: right">
        </colgroup>
        <thead>
            <tr style="background: #E7E7E7;">
                <th style="border-bottom: solid 1px black;">Produit</th>
                <th style="border-bottom: solid 1px black;">D??signation</th>
                <th style="border-bottom: solid 1px black;">Prix Unitaire</th>
                <th style="border-bottom: solid 1px black;">Quantit??</th>
                <th style="border-bottom: solid 1px black;">Prix Net</th>
            </tr>
        </thead>
        <tbody>
<?php
    $nb = rand(5, 11);
    $produits = array();
    $total = 0;
    for ($k=0; $k<$nb; $k++) {
        $num = rand(100000, 999999);
        $nom = "le produit n??".rand(1, 100);
        $qua = rand(1, 20);
        $prix = rand(100, 9999)/100.;
        $total+= $prix*$qua;
        $produits[] = array($num, $nom, $qua, $prix, rand(0, $qua));
?>
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $nom; ?></td>
                <td><?php echo number_format($prix, 2, ',', ' '); ?> &euro;</td>
                <td><?php echo $qua; ?></td>
                <td><?php echo number_format($prix*$qua, 2, ',', ' '); ?> &euro;</td>
            </tr>
<?php
    }
?>
            <tr style="background: #E7E7E7;">
                <th colspan="4" style="border-top: solid 1px black; text-align: right;">Total : </th>
                <th style="border-top: solid 1px black;"><?php echo number_format($total, 2, ',', ' '); ?> &euro;</th>
            </tr>
        </tbody>
    </table>
    <br>
    Cette reprise concerne la quantit?? et les mat??riels dont la r??f??rence figure sur le <a href="#document_reprise">document de reprise joint</a>.<br>
    Nous vous demandons de nous retourner ces produits en parfait ??tat et dans leur emballage d'origine.<br>
    <br>
    Nous vous demandons ??galement de coller imp??rativement l'autorisation de reprise jointe, sur le colis ?? reprendre afin de faciliter le traitement ?? l'entrep??t.<br>
    <br>
    Notre Service Clients ne manquera pas de revenir vers vous d??s que l'avoir de ces mat??riels sera ??tabli.<br>
    <nobreak>
        <br>
        Dans cette attente, nous vous prions de recevoir, Madame, Monsieur, Cher Client, nos meilleures salutations.<br>
        <br>
        <table cellspacing="0" style="width: 100%; text-align: left;">
            <tr>
                <td style="width:50%;"></td>
                <td style="width:50%; ">
                    Mle Jesuis CELIBATAIRE<br>
                    Service Relation Client<br>
                    Tel : 33 (0) 1 00 00 00 00<br>
                    Email : on_va@chez.moi<br>
                </td>
            </tr>
        </table>
    </nobreak>
</page>