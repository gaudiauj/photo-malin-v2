
<div class="row">
    <div class="col-md-12">
        <div class="news">

            <p class="auteur">Par <em><?php echo $news['auteur']; ?></em>, le <?php echo $news['dateAjout']->format('d/m/Y à H\hi'); ?></p>
            <h2><?php echo $news['titre']; ?></h2>
            <p><?php echo nl2br($news['contenu']); ?></p>

            <?php
            if ($news['dateAjout'] != $news['dateModif'])
            {
                ?>
                <p style="text-align: right;"><small><em>Modifiée le <?php echo $news['dateModif']->format('d/m/Y à H\hi'); ?></em></small></p>
<?php } ?>
        </div>
    </div>
</div>


<?php
if ($this->app->user()->getAttribute('pseudo'))
{
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="news">
                <h2>Ajouter un commentaire</h2>
                <form  class="form-horizontal" action="" method="post">
                    <?php
                    if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_INVALIDE, $erreurs))
                        echo
                        'L\'auteur est invalide.<br />';
                    if (isset($erreurs) && in_array(\Library\Entities\Comment::AUTEUR_TROP_LONG, $erreurs))
                        echo
                        'L\'auteur est trop long 20 caracteres maximum.<br />';
                    ?>
                    <input type="hidden" name="pseudo" value=<?php echo('"' . $this->app->user()->getAttribute('pseudo') . '"'); ?> /><br />

                    <?php
                    if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_INVALIDE, $erreurs))
                        echo
                        'Le contenu est invalide.<br />';
                    if (isset($erreurs) && in_array(\Library\Entities\Comment::CONTENU_TROP_LONG, $erreurs))
                        echo
                        'Le contenu est trop long limité à 1200 caracteres.<br />';
                    ?>
                    <div class="form-group">
                        <label>Contenu</label>
                        <textarea class="form-control" name="contenu" rows="7" cols="100"><?php if (isset($comment)) echo htmlspecialchars($comment['contenu']); ?></textarea><br />

                        <input type="submit" value="Commenter" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="news">
                <p>vous devez être connecter pour laisser un message</p>
            </div>
        </div>
    </div>
                <?php
            }
            ?>
<div class="row">
    <div class="col-md-12">
        <div class="news">
            <?php
            if (empty($comments))
            {
                ?>
                <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
                <?php
            }

            foreach ($comments as $comment)
            {
                ?>
                <div class="comments" id=<?php echo("'com ments-" . $comment['id'] . "'"); ?>>
                    <fieldset>
                        <legend>
                            Posté par <a href=<?php echo('"/jeantest/web/profil-' . $comment['auteur'] . '"'); ?>><strong><?php echo htmlspecialchars($comment['auteur']); ?></strong></a> le <?php echo $comment['date']->format('d/m/Y à H\hi'); ?>
    <?php
    if ($user->isAuthenticated())
    {
        ?> -
                                <a href="admin/comment-update-<?php echo $comment['id']; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a href="admin/comment-delete-<?php echo $comment['id']; ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                <?php } ?>
                        </legend>
                        <p><?php echo (nl2br(htmlspecialchars($comment['contenu']))); ?></p>
                    </fieldset>
                </div>

    <?php
}
?>
        </div>
    </div>
</div>
