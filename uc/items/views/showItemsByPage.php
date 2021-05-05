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

<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>marque</th>
        <th>nom</th>
        <th>description</th>
        <th>prix</th>
    </tr>

    <?php
    // On fait une boucle pour lister tout ce que contient la table :
    foreach ($items as $i) :
        // Seul le Webmanager peut éditer/supprimer toutes les définitions
        // Le ProductManager ou le SaleManager peuvent éditer/supprimer leur propres définitions
        $canEdit = (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER));
        $c1 = Session::getUser()->hasCurrentRole(array(User::USER_ROLE_PRODUCT_MANAGER, User::USER_ROLE_SALE_MANAGER));
        

        if ($c1) {
            $canEdit = true;
        }
    ?>
        <tr>
            <td><?= $i->manufacturer ?></td>
            <td><?= $i->name; ?></td>
            <td><?= $i->description; ?></td>
            <td><?= $i->price ?></td>
      
            <td>
                <?php if ($canEdit) : ?>

                    <a class="btn btn-primary" href="<?= Routes::PathTo('items', 'editItems') ?>&id=<?= $i->idItem ?>"><span class="fas fa-pen"></span></a>

                    <button data-toggle="modal" class="btn btn-danger" href="#delete<?= $d->id ?>"><span class="fas fa-trash-alt"></span></button>
                    <div class="modal" id="delete<?= $i->idItem ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Voulez vous vraiement supprimer cet Article ?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?= $i->manufacturer; ?>
                                        <?= $i->name; ?> :
                                        <?= $i->description; ?>
                                        <?= $i->price; ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="<?= Routes::PathTo('items', 'deleteItem') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $i->id ?>" />
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