<?php 
require_once 'uc/temporary/model/Simulation.php';

?>

<form class="form-inline" action="<?= Routes::PathTo('items', 'searchItems') ?>" method="post">
    <div class="form-group mr-sm-3 mb-2">
        <label for="name" class="m-2">Article à trouver</label>
        <input type="text" class="form-control" name="name" id="name" size="50" placeholder="Laisser le texte vide pour visualiser tout le dictionnaire" value="<?= $name ?>">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
</form>

<div class="d-flex flex-row justify-content-between">
    <div class="my-2"><?= $count ?> Articles trouvées</div>
    <div><?= Html::PageNavigator($pages, $page) ?></div>
   
</div>

<form action="" method="post">
                 <select class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>marque</th>
        <th>nom</th>
        <th>description</th>
        <th>prix</th>
        <th>catégorie</th>
        <th>Détail</th>
        <th>Quantité</th>
        
    </tr>

    <?php
    // On fait une boucle pour lister tout ce que contient la table :
    foreach ($items as $i) :
        // Seul le Webmanager peut éditer/supprimer toutes les définitions
        // Le ProductManager ou le SaleManager peuvent éditer/supprimer leur propres définitions
        $canEdit = (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER));
        $c1 = Session::getUser()->hasCurrentRole(array(User::USER_ROLE_PRODUCT_MANAGER, User::USER_ROLE_SALE_MANAGER));
        $customer =  Session::getUser()->hasCurrentRole(array(User::USER_ROLE_CUSTOMER));

        if ($c1) {
            $canEdit = true;
        }
    ?>
    
    <form class="form-inline" action="<?= Routes::PathTo('items', 'detailItems') ?>" method="POST">
        <tr>
               <?php
                  if($i->published == $publishedON || $c1) {
                        ?> 
            <td><input type="hidden" name="idCommand" value="0" ><?= $i->manufacturer ?></td>
            <td><input type="hidden" name="id" value="<?= $i->idItem?>" ><?= $i->name; ?></td>
            <td><?= $i->description; ?></td>
            <td><?= $i->price ?></td>
           
            <td><?php $tableau[] = Simulation::getAllCategories();
                echo $tableau[0][$i->idCategory];
                ?></td>
           
            <?php } else {} ?>
            
            <td><button type="submit" class="btn btn-primary mb-2">Détail</button></td>           
            </form>
            <?php if ($customer) : ?>
            <form class="form-inline" action="<?= Routes::PathTo('panier', 'addItem') ?>" method="POST">
            <input type="hidden" name="id" value="<?= $i->idItem ?>" />
            <td><input type="number" name="quantity" value="1" /></td>
            <td><button type="submit" class="btn btn-primary mb-2">Ajouter au panier</button></td>
            </form>   
            <?php endif; ?>
            <td>
                <?php if ($canEdit) : ?>

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