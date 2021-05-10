
<div class="container">
    <form action="<?= Routes::PathTo('items', 'saveItem') ?>" method="post" class="border border-primary p-1 rounded">
        <div class="form-group">
            <label for="name">Nom de l'article</label>
            <?php if (!empty($errors['name'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['name'] ?></div>
            <?php endif; ?>
            <input type="text" class="form-control" id="name" name="name" placeholder="Saisir le nom de l'article" value="<?= $itemSelect->getName() ?>">
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <?php if (!empty($errors['description'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['description'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Saisir la description"><?= $itemSelect->getDescription() ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">price</label>
            <?php if (!empty($errors['price'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['price'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="price" name="price" rows="3" placeholder="Saisir le prix"><?= $itemSelect->getPrice() ?></textarea>
        </div>
        <div class="form-group">
            <label for="Manufacturer">manufacturer</label>
            <?php if (!empty($errors['manufacturer'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['manufacturer'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="manufacturer" name="manufacturer" rows="3" placeholder="Saisir le fabricant"><?= $itemSelect->getManufacturer() ?></textarea>
        </div>
        <div class="form-group">
            <label for="SerialNumber">serial number</label>
            <?php if (!empty($errors['serialNumber'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['serialNumber'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="serialNumber" name="serialNumber" rows="3" placeholder="Saisir le numéro de série"><?= $itemSelect->getPartNumber() ?></textarea>
        </div>
        <div class="form-group">
            <label for="published">published</label>
            <?php if (!empty($errors['published'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['published'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="published" name="published" rows="3" placeholder="l'article est-il publié ?"><?= $itemSelect->getPublished() ?></textarea>
        </div>
        <div class="form-group">
            <label for="categorie">catégorie</label>
            <?php if (!empty($errors['categorie'])) : ?>
                <div class="alert alert-danger" role="alert"><?= $errors['categorie'] ?></div>
            <?php endif; ?>
            <textarea class="form-control" id="categorie" name="categorie" rows="3" placeholder="Saisir le prix"><?= $itemSelect->getIdCategory() ?></textarea>
        </div>
        <input type="hidden" id="id" name="id" value="<?= $itemSelect->getIdItem(); ?>">
        <div class="row">
            <div class="col"> <a href="<?= Routes::PathTo('items', 'showItems') ?>" class='btn btn-warning btn-block'>Revenir à la liste</a> </div>
            <div class="col"><button type='submit' class='btn btn-success btn-block'> <?= $mode ?> </button> </div>
        </div>
    </form>
</div>