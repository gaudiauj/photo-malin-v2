<?php ?>
<div class="container">
    <div class="row">	
        <div class='message'></div>
    </div>
    <div class="row">					
        <div class="jumbotron" style="height: 600px;">
            <h2> connexion : </h2>
            <form  method="post" class="form-horizontal" action="" id="inscription" role="form" enctype="multipart/form-data">					
                <div class="form-group" id="div_pseudo_insc">
                    <label for="pseudo_insc" class="control-label">Pseudo</label>
                    <input type="text" class="form-control" id="Pseudo" placeholder="Pseudo" ><br />						 						  
                </div>				  
                <div class="form-group" id="div_mdp_insc">
                    <label for="pass_insc" class=" control-label">mot de passe</label>						
                    <input type="password" class="form-control" id="pass" placeholder="mot de passe"><br />						
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