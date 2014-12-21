<form action="" method="post" role="form" class="form-horizontal">
    <p>
    <div class="form-group ">
        <?php if (isset($erreurs) && in_array(\Library\Entities\News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
        <label>Auteur</label><br />
        <input type="text" name="auteur" value="<?php if (isset($news)) echo $news['auteur']; ?>" /><br />
    </div>
    <div class="form-group">
        <?php if (isset($erreurs) && in_array(\Library\Entities\News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; 
        if (isset($erreurs) && in_array(\Library\Entities\News::TITRE_TROP_LONG, $erreurs)) echo 'Le titre est trop long.<br />'; 
        ?>
        <label>Titre</label><br /><input type="text" name="titre" value="<?php if (isset($news)) echo $news['titre']; ?>" /><br />
    </div>
    <?php if (isset($erreurs) && in_array(\Library\Entities\News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
    <div class="form-group">
        <label>Contenu</label><br /><textarea rows="8" cols="100" name="contenu"><?php if (isset($news)) echo $news['contenu']; ?></textarea><br />
    </div>

    <?php
    if (isset($news) && !$news->isNew()) {
        ?>
        <input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
        <input type="submit" value="Modifier" name="modifier" />
        <?php
    } else {
        ?>
        <input type="submit" value="Ajouter" />
        <?php
    }
    ?>
</p>
</form>