<div class="container">
    <div id="dropfile" class="jumbotron" style="min-height: 400px">

        <form method="post" action="gestion/envoi_fichier.php" id="selection_fichier"  enctype="multipart/form-data">
            <input type="file" name="fichier" id="fichier"  /><br /><br />

            <div id="prev"></div>
            <p style="text-align: center"><strong>vous pouvez aussi directement glisser vos images ici</strong></p>

        </form>
    </div>
    <span id="progress" style="background-color: green;"></span><p><span class="percents"></span></p></div>
<div id="guillaumedaix" title="ajouter photo">
    <img id="preview" src="#" alt="votre image" />

    <form method="post" action="gestion/envoi_fichier.php" id="uploadForm"  enctype="multipart/form-data">

        <label for="titre">titre de l'image : </label><br /><input type="text" name="titre" id="titre" /><br /><br />
        <label for="commentaire_photo">commentaire photo : </label><br /><textarea name="commentaire" rows="4" cols="50" id="commentaire_photo" ></textarea><br /><br />
        <input type="hidden" name="auteur" id="auteur" value=<?php echo ('"'.$_SESSION['pseudo'].'"');?> />
        <label for="photographe">nom du photographe : </label><br /><input type="text" name="photographe" id="photographe" /><br /><br />
        <input type="radio" name="privee" value="privee" id="privee" /> <label for="privee">photo privée</label>
        <input type="radio" name="privee" value="public" id="public" /> <label for="public">photo public</label><br /><br />
        <input type="submit" value="Envoyer le fichier" id="bouton_envoyer" /><br /><br />

    </form>

</div>
<div id=" erreur"></div>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript"  src="scripts/envoi.js"></script>
</body>
</html>
