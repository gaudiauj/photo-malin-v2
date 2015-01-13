
<p style="text-align: center">Il y a actuellement <?php echo $nombreNews; ?> news. En voici la liste :</p>

<table class="table table-striped">
    <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Dernière modification</th><th>Action</th></tr>
    <?php
    foreach ($listeNews as $news)
    {
        echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le ' . $news['dateModif']->format('d/m/Y à H\hi')), '</td><td><a href="news-update-', $news['id'], '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a href="news-delete-', $news['id'], '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a> <a href="../news-', $news['id'], '"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a></td></tr>', "\n";
    }
    ?>
</table>
<a href="http://localhost/jeantest/web/admin/news-insert"><button type="button" class="btn btn-default" aria-label="Left Align">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    </button></a>
<?php require '_pagination.php'; ?>
