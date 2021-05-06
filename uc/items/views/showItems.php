<?php
$canDelete = (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER));
?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>IdItem</th>
        <th>nom</th>
       
        <th>prix</th>
        
     
       
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
            <td><?= $i->idItem ?></td>
            <td><?= $i->name; ?></td>
      
            <td><?= $i->price ?></td>
      
         
            <?php if ($canDelete) : ?>
                <td>
                    <button data-toggle="modal" class="btn btn-danger" href="#delete<?= $i->id ?>"><span class="fas fa-trash-alt"></span></button>
                    <div class="modal" id="delete<?= $i->id ?>" tabindex="-1">
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
                          
                                        <?= $i->price ?>

                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="<?= Routes::PathTo('Items', 'deleteItems') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $i->id ?>" />
                                        <input class="btn" type="submit" name="submit" value="Supprimer" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            <?php endif; ?>
        </tr>
    <?php endforeach; ?>
</table>