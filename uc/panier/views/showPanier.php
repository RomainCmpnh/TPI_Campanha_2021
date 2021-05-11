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
        </tr>
    <?php endforeach; ?>
</table>