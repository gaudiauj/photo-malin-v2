
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <form action="" method="post" class="form-horizontal" role="form">
                <div class="form-group ">
                    <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
                    <label>Pseudo</label><br /><input type="text" name="pseudo" value="<?php echo htmlspecialchars($comment['auteur']); ?>" /><br />
                </div>
                <div class="form-group ">
                    <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                    <label>Contenu</label><br /><textarea name="contenu" rows="7" cols="100"><?php echo htmlspecialchars($comment['contenu']); ?></textarea><br />
                </div>
                <input type="hidden" name="news" value="<?php echo $comment['news']; ?>" />
                <input type="submit" value="Modifier" />
            </form>
        </div>
    </div>
</div>