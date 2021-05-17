<?php 
require_once 'commons/views/Html.php';
require_once 'uc/items/models/Item.php';
require_once 'uc/command/model/command.php';
?>

<div class="d-flex flex-row justify-content-between">
    <div class="my-2"><?= $count . " CHF"?> montant total </div>
</div>
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
            <form class="form-inline" action="<?= Routes::PathTo('panier', 'finaliser') ?>" method="POST">
            <input type="hidden" name="idCommand" value="<?= $i->idCommand ?>" />
            <input type="hidden" name="id" value="<?= $i->idItem ?>" />
            <td><button type="submit" class="btn btn-primary mb-2">Finaliser ma commande</button></td>
            </form>
            <td><button data-toggle="modal" class="btn btn-danger" href="#delete<?= $i->idItem ?>"><span class="fas fa-trash-alt"></span></button></td>
            <div class="modal" id="delete<?= $i->idItem ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Voulez vous vraiement supprimer cet article du panier ?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="<?= Routes::PathTo('panier', 'deleteItem') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $i->idItem ?>" />
                                        <input type="hidden" name="idCommand" value="<?= $i->idCommand ?>" />
                                        <input class="btn" type="submit" name="submit" value="Supprimer" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
        </tr>
    <?php endforeach; ?>
</table>