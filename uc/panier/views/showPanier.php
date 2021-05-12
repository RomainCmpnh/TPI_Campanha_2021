<?php 
require_once 'commons/views/Html.php';
require_once 'uc/items/models/Item.php';
?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>Nom de l'article</th>
        <th>Marque</th>
        <th>Numéro de série</th>
        <th>Prix</th>
        <th>Quantité à commander</th>
        <th>Finaliser ma commande</th>
    </tr>

    <?php
    foreach ($commands as $i) :
    ?>
        <tr>
        <td><?php $Item = Item::FindById($i->idItem);
                echo $Item->getName();
                ?></td>
                <td><?=$Item->getManufacturer();?></td>
                <td><?=$Item->getPartNumber();?></td>
            <td><?= $i->salePrice ?></td>
            <td><?= $i->quantity; ?></td>
            <form class="form-inline" action="<?= Routes::PathTo('panier', 'pdfPanier') ?>" method="POST">
            <input type="hidden" name="id" value="<?= $i->idItem ?>" />
            <td><button type="submit" class="btn btn-primary mb-2">Finaliser ma commande</button></td>
            </form>   
        </tr>
    <?php endforeach; ?>
</table>