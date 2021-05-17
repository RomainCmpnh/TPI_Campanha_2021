<?php 
require_once 'commons/views/Html.php';
require_once 'uc/command/model/command.php';
require_once 'uc/panier/models/commandItem.php';
?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>Statut de la commande</th>
        <th>Date de la commande</th>
        <th>PDF</th>
    </tr>

    <?php
    
    foreach ($commands as $i) :
        $idCommand = $i->idCommand;
      

 

    ?>
        <tr>
            <td><?= $i->commandStatus; ?></td>
            <td><?= $i->commandDate; ?></td>

            <form class="form-inline" action="<?= Routes::PathTo('command', 'pdfPanier') ?>" target="_blank" method="POST">
            <input type="hidden" name="idCommand" value="<?= $i->idCommand ?>" />
         
            <td><button type="submit" class="btn btn-primary mb-2">Détail</button></td>           
            </form>
        </tr>
    <?php endforeach; ?>
</table>