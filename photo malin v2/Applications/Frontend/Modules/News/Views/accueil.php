<div class="fond">   
    <img id="background" >
</div>
    <div class="container accueil">
        <div class="row">
            <div class="col-md-12 hidden-md hidden-lg ">
                <div class="text-acceuil">
                    <h1>attention</h1>
                    <p>malheuresement il semble que vous surfez avec un ecran de petite taille, ce site est optimiser pour les grand ecran (992px ou plus) vous pouvez toujours profiter de ce site cependant vous pouriez avoir quelque problème d'affichage </p>
                </div>
            </div>
        </div>
        <div class="row">            
            <div class="col-md-6">
                <div class="text-acceuil">
                    <h1>bienvenue sur photo malin</h1>
                    <p>photo malin vous permettra d'avoirs accés à un grand nombre de photos de grande qualité pour usage commercial à un prix imbatable et peut être trouver la perle rare, mais aussi de proposer vos photos a la vente afin de pourquoi pas taper dans l'oeil d'un grand magazine. Et oui gagner de l'argent avec vos photo c'est possible</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-acceuil" >
                    <h2> INSCRIPTION : </h2>
                    <div class="alert alert-danger" id="message_insc"></div>	
                    <form  method="post" class="form-horizontal" action="" id="inscription" role="form" enctype="multipart/form-data">					
                        <div class="form-group" id="div_pseudo_insc">
                            <label for="pseudo_insc" class="control-label">Pseudo</label>
                            <input type="text" class="form-control" name="pseudo" id="Pseudo_insc" placeholder="Pseudo" ><br />						 						  
                        </div>				  
                        <div class="form-group" id="div_mdp_insc">
                            <label for="pass_insc" class=" control-label">mot de passe</label>						
                            <input type="password" class="form-control" id="pass_insc" name="pass_insc" placeholder="mot de passe"><br />						
                        </div>
                        <div class="form-group" id="div_mdp_insc_verif">
                            <label for="pass_insc_verif" class=" control-label">retaper mot de passe</label>
                            <input type="password" class="form-control" id="pass_insc_verif" name="pass_insc_verif" placeholder="mot de passe"><br />
                        </div>
                        <div class="form-group">
                            <label for="mail_insc" class="control-label">Email</label>
                            <input type="email" class="form-control" id="mail_insc" name="mail_insc" placeholder="Email"><br />
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
    </div>
<script>
    $('.accueil').css('margin-top','150px');
       $(function () {
        var i = 1;
        $("#background").css('height', '100%').css('width', '100%').attr('src', 'img/6.jpg');
        setInterval(function () {
            if (i == 5)
                i = 0;
            slider(i++);
        }, 18000);
    });

    function slider(i)
    {
        var fond = new Array("1.jpg", "2.jpg", "3.jpg", "6.jpg", "5.jpg")
        $("#background").fadeTo( "slow", 0.05)
        $("#background").delay(100).queue(function() {
      $(this).attr('src','./img/'+fond[i]).dequeue();
    }).fadeTo( "slow", 1 );
    }
</script>
<script>
    $(function () {
        $('#message_insc').hide();

        $('#Pseudo_insc').keyup(function () {
            if ($('#Pseudo_insc').val().length < 4)
            {
                $('#message_insc').html("le pseudo doit faire au moins 4 caracteres").show();
                $('span[id^="succes_pseudo"]').remove();
                $('#div_pseudo_insc').removeClass("has-success has-feedback").addClass("has-error has-feedback").append(' <span id="alert_pseudo" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else if ($('#Pseudo_insc').val().length > 20)
            {
                $('#message_insc').html("le pseudo doit faire moins de 20 caracteres").show();
                $('span[id^="succes_pseudo"]').remove();
                $('#div_pseudo_insc').removeClass("has-success has-feedback").addClass("has-error has-feedback").append(' <span id="alert_pseudo" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else
            {
                $('#message_insc').hide();
                $('span[id^="alert_pseudo"]').remove();
                $('#div_pseudo_insc').removeClass("has-error has-feedback").addClass("has-success has-feedback").append(' <span  id="succes_pseudo" class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }

        });
        $('#pass_insc').keyup(function () {
            if ($('#pass_insc').val().length < 6)
            {
                $('#message_insc').html("le mot de passe doit faire au moins 6 caracteres").show();
                $('span[id^="succes_mdp"]').remove();
                $('#div_mdp_insc').removeClass("has-success has-feedback").addClass("has-error has-feedback").append(' <span id="alert_mdp" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else
            {
                $('#message_insc').hide();
                $('span[id^="alert_mdp"]').remove();
                $('#div_mdp_insc').removeClass("has-error has-feedback").addClass("has-success has-feedback").append(' <span  id="succes_mdp" class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }
            if ($('#pass_insc_verif').val() == $('#pass_insc').val())
            {
                $('#message_insc').hide();
                $('span[id^="alert_mdp_verif"]').remove();
                $('#div_mdp_insc_verif').removeClass("has-error has-feedback").addClass("has-success has-feedback").append(' <span  id="succes_mdp_verif" class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }
            else
            {
                $('#message_insc').html("les mots de passe doivent etre identique").show();
                $('span[id^="succes_mdp_verif"]').remove();
                $('#div_mdp_insc_verif').removeClass("has-success has-feedback").addClass("has-error has-feedback").append(' <span id="alert_mdp_verif" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }

        });
        $('#pass_insc_verif').keyup(function () {
            if ($('#pass_insc_verif').val() != $('#pass_insc').val())
            {
                $('#message_insc').html("les mots de passe doivent etre identique").show();
                $('span[id^="succes_mdp_verif"]').remove();
                $('#div_mdp_insc_verif').removeClass("has-success has-feedback").addClass("has-error has-feedback").append(' <span id="alert_mdp_verif" class="glyphicon glyphicon-remove form-control-feedback"></span>');
            }
            else
            {
                $('#message_insc').hide();
                $('span[id^="alert_mdp_verif"]').remove();
                $('#div_mdp_insc_verif').removeClass("has-error has-feedback").addClass("has-success has-feedback").append(' <span  id="succes_mdp_verif" class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }

        });

        $('#bouton_inscrire').click(function (e) {
            e.preventDefault();
            {
                $.post('inscription-back', {pseudo: $('#Pseudo_insc').val(), pass_insc: $('#pass_insc').val(), pass_insc_verif: $('#pass_insc_verif').val(), mail_insc: $('#mail_insc').val()}, function (data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj["reussi"] != undefined)
                    {
                        $('#message_insc').removeClass("alert-danger").addClass("alert-success").html(obj['reussi']).wrapAll(document.createElement("p")).show();
                    }
                    else
                    {
                        $('#message_insc').html("")
                        jQuery.each(obj, function (i, val) {
                            $('#message_insc').append(val);
                        });
                        $('#message_insc').show();
                    }
                });
            }
        });

    });
</script>