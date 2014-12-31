<?php if($profil)
{
    ?>
<div class="container">
    <div class="row">					
        <div class="news" >
            <h2><?php echo('Les '.$nombrecomm.' derniers commentaires de '.$pseudo);?> </h2>
                <?php
            foreach ($comments as $comment) {
                ?>
                <div class="comments" id=<?php echo("'comments-" . $comment['id'] . "'"); ?>>
                    <fieldset>
                        <legend>
                            Posté par <strong><?php echo htmlspecialchars($comment['auteur']); ?></strong> le <?php echo $comment['date']->format('d/m/Y à H\hi'); echo(' <a href="news-'.$comment['news'].'#comments-'.$comment['id'].'"> <span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </a>'); ?>
                            <?php if ($user->isAuthenticated()) { ?> -
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
<?php } else
{
    require '_noprofil.php';
}
