<div class="container">
    <div class="row">					
        <div class="jumbotron" >
            <h2> CONNEXION : </h2>
            <?php
            if(isset($connecte) && $connecte)
            {
            ?>
            <div class="alert alert-success" role="alert">Vous êtes maintenant connecté !</div>
            <?php
            }
                else if (isset($connecte)) {
            ?>
            <div class="alert alert-danger" id="message_insc">Mauvais mot de passe ou mauvais pseudo</div>
            <?php
            }?>
            <form  method="post" class="form-horizontal" action="" id="inscription" role="form" enctype="multipart/form-data">					
                <div class="form-group" id="div_pseudo_co">
                    <label for="pseudo_insc" class="control-label">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo_co" id="Pseudo_co" placeholder="Pseudo" ><br />						 						  
                </div>				  
                <div class="form-group" id="div_mdp_co">
                    <label for="pass_insc" class=" control-label">mot de passe</label>						
                    <input type="password" class="form-control" id="pass_co" name="pass_co" placeholder="mot de passe"><br />						
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-default" id="bouton_inscrire">valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>