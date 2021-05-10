<?php 
require_once 'uc/temporary/model/Simulation.php';
require_once 'commons/views/Html.php';
?>
<?php
$canDelete = (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER));
?>
<table class="table table-bordered table-striped table-condensed">
<tr>
    <form action="" method="post">
                 <h2>Choisissez une categorie</h2>
                 <select id="listCategorieOne">
                 <?php
                 $tableau[] = Simulation::getAllCategories();
                 for($b = 1; $b <= 18; $b++){
                 echo "<option value" . $b . ">" . $tableau[0][$b] . "</option>";
                 }

              //  echo '<ul class="nav navbar-nav navbar-left">' . "\n";
               // foreach (Simulation::getAllCategories() as $dropDownItem) {
                 //   Html::DropDownItem($dropDownItem);
               // }
               // echo "</ul>\n";

                
                 ?>
                </select>     
    </form>
    </tr>
    <tr>
        <th>IdItem</th>
        <th>nom</th>
        <th>prix</th>
        <th>Quantité à commander</th>
        <?php if ($canDelete) : ?>
            <th>Edition</th>
        <?php endif; ?>
    </tr>

    <?php
    // On fait une boucle pour lister tout ce que contient la table :
    foreach ($items as $i) :
        // Seul le Webmanager peut éditer/supprimer toutes les articles
        // Le ProductManager ou le SaleManager peuvent éditer/supprimer leur propres articles
    ?>

        <tr>
        <?php  
        
        ?>
            <td><?= $i->idItem ?></td>
            <td><?= $i->name; ?></td>
            <td><?= $i->price ?></td>
            <td><input type="number" name="quantity[<?= $i->partNumber?>]" value="0" /></td>
      
         <td>
            <?php if ($canDelete) : ?>

                <a class="btn btn-primary" href="<?= Routes::PathTo('items', 'editItem') ?>&id=<?= $i->idItem ?>"><span class="fas fa-pen"></span></a>

            <button data-toggle="modal" class="btn btn-danger" href="#delete<?= $i->idItem ?>"><span class="fas fa-trash-alt"></span></button>
            <div class="modal" id="delete<?= $i->idItem ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Voulez vous vraiement supprimer cet article ?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
            <div class="modal-body">
                <p><?= $i->name; ?>
                
                <?php 
                $tableau[] = Simulation::getAllCategories();
                echo $tableau[0][$i->idCategory];
                ?>
                </p>
            </div>
            <div class="modal-footer">
                <form action="<?= Routes::PathTo('items', 'deleteItems') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $i->idItem ?>" />
                    <input class="btn" type="submit" name="submit" value="Supprimer" />
                </form>
            </div>
        </div>
    </div>
</div>
            <?php endif; ?>
            </td>
            
        </tr>
    <?php endforeach; ?>
</table>