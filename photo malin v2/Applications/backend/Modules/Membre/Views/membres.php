<p style="text-align: center">Il y a actuellement <?php echo $nombreMembres; ?> membres. En voici la liste :</p>
<table class="table table-striped">
    <tr><th>Pseudo</th><th>Date Inscription</th><th>Mail</th><th>Action</th></tr>
    <?php
    foreach ($listeMembres as $membres)
    {
        echo '<tr><td>', $membres->getPseudo(), '</td><td>le ', $membres->getDateInscription()->format('d/m/Y à H\hi'), '</td><td>', $membres->getMail(), '</td><td></td></tr>', "\n";
    }
    ?>
</table>
<?php require '_pagination.php'; ?>