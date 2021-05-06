
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>nom</th>
        <th>description</th>
        <th>marque</th>
        <th>prix</th>
        <th>catégorie</th>
        <th>disponibilité</th>  
    </tr>
    
 
        <tr>
            <td><?= $itemSelect->getName() ?></td>
            <td><?= $itemSelect->getDescription() ?></td>
            <td><?= $itemSelect->getManufacturer() ?></td>
            <td><?= $itemSelect->getPrice() ?></td>
            <td><?php $tableau[] = Item::getAllCategories();
                echo $tableau[0][$itemSelect->getIdCategory()];
                ?></td>      
        </tr>
        <tr>
        <th>image</th>
    </tr>
 
</table>