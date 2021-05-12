<?php 
require_once 'commons/views/Html.php';
require_once 'uc/command/model/command.php';
?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>Statut de la commande</th>
        <th>Date de la commande</th>
        <th>Nom du client</th>
        <th>Prénon du client</th>
    </tr>

    <?php
    foreach ($commands as $i) :
        $canEdit = false;
        $today = date("Y-m-d H:i:s");
        if($today < strtotime('-90 days') && $i->commandStatus == "Sent" || $i->commandStatus == "PartiallyDelivered" || $i->commandStatus == "Finalised") {
           $canEdit = true;
        }
    ?>
        <tr>
            <td><?= $i->commandStatus; ?></td>
            <td><?= $i->commandDate; ?></td>
            <td><?= $i->firstname ?></td>
            <td><?= $i->lastname ?></td>
            <td>
            <?php if ($canEdit) : ?>

<button data-toggle="modal" class="btn btn-danger" href="#delete<?= $i->idCommand ?>"><span class="fas fa-trash-alt"></span></button>
<div class="modal" id="delete<?= $i->idCommand ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Voulez vous vraiement supprimer cette commande ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            <div class="modal-footer">
                <form action="<?= Routes::PathTo('command', 'deleteCommand') ?>" method="post">
                    <input type="hidden" name="id" value="<?= $i->idCommand ?>" />
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