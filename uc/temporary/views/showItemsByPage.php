<form class="form-inline" action="<?= Routes::PathTo('items', 'searchDefinitions') ?>" method="post">
    <div class="form-group mr-sm-3 mb-2">
        <label for="word" class="m-2">Mot à trouver</label>
        <input type="text" class="form-control" name="word" id="word" size="50" placeholder="Laisser le texte vide pour visualiser tout le dictionnaire" value="<?= $word ?>">
    </div>
    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
</form>

<div class="d-flex flex-row justify-content-between">
    <div class="my-2"><?= $count ?> Définitions trouvées</div>
    <div><?= Html::PageNavigator($pages, $page) ?></div>
</div>

<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>Id</th>
        <th>Mot</th>
        <th>Définition</th>
        <th>Auteur</th>
        <th>Edition</th>
    </tr>

    <?php
    // On fait une boucle pour lister tout ce que contient la table :
    foreach ($definitions as $d) :
        // Seul le Webmanager peut éditer/supprimer toutes les définitions
        // Le ProductManager ou le SaleManager peuvent éditer/supprimer leur propres définitions
        $canEdit = (Session::getUser()->hasCurrentRole(User::USER_ROLE_WEB_MANAGER));
        $c1 = Session::getUser()->hasCurrentRole(array(User::USER_ROLE_PRODUCT_MANAGER, User::USER_ROLE_SALE_MANAGER));
        $c2 = Session::getUser()->isOwner($d->idOwner);

        if ($c1 && $c2) {
            $canEdit = true;
        }
    ?>
        <tr>
            <td><?= $d->id ?></td>
            <td><?= $d->word; ?></td>
            <td><?= $d->definition; ?></td>
            <td><?= $d->firstName . " " . $d->lastName; ?></td>
            <td>
                <?php if ($canEdit) : ?>

                    <a class="btn btn-primary" href="<?= Routes::PathTo('dico', 'editDefinition') ?>&id=<?= $d->id ?>"><span class="fas fa-pen"></span></a>

                    <button data-toggle="modal" class="btn btn-danger" href="#delete<?= $d->id ?>"><span class="fas fa-trash-alt"></span></button>
                    <div class="modal" id="delete<?= $d->id ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Voulez vous vraiement supprimer cette définition ?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><?= $d->id; ?>
                                        <?= $d->word; ?> :
                                        <?= $d->definition; ?>, publiée par
                                        <?= $d->idOwner; ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="<?= Routes::PathTo('dico', 'deleteDefinition') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $d->id ?>" />
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