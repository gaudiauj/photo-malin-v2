
<p style="text-align: center">Il y a actuellement <?php echo $nombreComments; ?> commentaires. En voici la liste :</p>

<table class="table table-striped">
  <tr><th>Auteur</th><th>Date d'ajout</th><th>contenu</th><th>Action</th></tr>
<?php
foreach ($listeComments as $comments)
{
  echo '<tr><td>', $comments['auteur'], '</td><td>le ', $comments['date']->format('d/m/Y à H\hi'), '</td><td>', $comments['contenu'], '</td><td><a href="comment-update-', $comments['id'], '"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a href="comment-delete-', $comments['id'], '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></a> <a href="../news-', $comments['news'],'#comments-',$comments['id'],'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></a></td></tr>', "\n";
}
?>
</table>
<?php require '_pagination.php';?>

