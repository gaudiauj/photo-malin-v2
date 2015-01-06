<div id="overlay">
</div>
<div id="cache">
    <div id="tri" class="general">
        <p> <label for="nom_triage">trier par : </label><select name="nom_triage" id="nom_triage"><option value="id">date</option><option value="photographe">photographe</option>
                <option value="auteur">ajouteur</option>   <option value="appareil photo">appareil photo</option>  <option value="titre">titre</option><option value="commentaire">commentaire</option></select>  <label for="trier">trier par ordre : </label><select name="trier" id="trier">
                <option value="DESC">decroissant</option>
                <option value="">croissant</option>
            </select>
            <label for="nom_recherche">rechercher dans : </label>
            <select name="nom_recherche" id="nom_recherche"><option value="photographe">photographe</option>
                <option value="auteur">ajouteur</option> <option value="appareil photo">appareil photo</option>  <option value="titre">titre</option><option value="commentaire">commentaire</option></select>
            <input type="search" size="10" id="recherche" placeholder="recherche"/>
        </p>
    </div>
    <div id="aff_photo">
        <?php
  var_dump($photos);
        ?>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="./scripts/phototest.js"></script>