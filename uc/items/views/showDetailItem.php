<?php 
require_once 'uc/temporary/model/Simulation.php';
?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>nom</th>
        <th>description</th>
        <th>marque</th>
        <th>prix</th>
        <th>catégorie</th>
        <th>Numéro de série</th>  
    </tr>
        <tr>
            <td><?= $itemSelect->getName() ?></td>
            <td><?= $itemSelect->getDescription() ?></td>
            <td><?= $itemSelect->getManufacturer() ?></td>
            <td><?= $itemSelect->getPrice() ?></td>
            <td><?php $tableau[] = Simulation::getAllCategories();
                echo $tableau[0][$itemSelect->getIdCategory()];
                ?></td>     
            <td><?=$itemSelect->getPartNumber()?></td>  
            
        </tr>
        <tr>
        <th>image</th>
    </tr>
 
</table>