
<div class="row">
    <div class="col-md-12">
        <div class="news">

            <p class="auteur">Par <em><?php echo $news['auteur']; ?></em>, le <?php echo $news['dateAjout']->format('d/m/Y à H\hi'); ?></p>
            <h2><?php echo $news['titre']; ?></h2>
            <p><?php echo nl2br($news['contenu']); ?></p>

            <?php if ($news['dateAjout'] != $news['dateModif']) { ?>
                <p style="text-align: right;"><small><em>Modifiée le <?php echo $news['dateModif']->format('d/m/Y à H\hi'); ?></em></small></p>
            <?php } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="news">
            <h2>Ajouter un commentaire</h2>
            <form action="" method="post">
                <p>
                    <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
                    <label>Pseudo</label>
                    <input type="text" name="pseudo" value="" /><br />

                    <?php if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                    <label>Contenu</label>
                    <textarea name="contenu" rows="7" cols="50"><?php if (isset($comment)) echo htmlspecialchars($comment['contenu']); ?></textarea><br />

                    <input type="submit" value="Commenter" />
                </p>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="news">
            <?php
            if (empty($comments)) {
                ?>
                <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
                <?php
            }

            foreach ($comments as $comment) {
                ?>
                <fieldset>
                    <legend>
                        Posté par <strong><?php echo htmlspecialchars($comment['auteur']); ?></strong> le <?php echo $comment['date']->format('d/m/Y à H\hi'); ?>
                    </legend>
                    <p><?php echo (nl2br(htmlspecialchars($comment['contenu']))); ?></p>
                </fieldset>
    <?php
}
?>
        </div>
    </div>
</div>
