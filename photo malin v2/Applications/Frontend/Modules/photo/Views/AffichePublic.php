<div id="overlay">
</div>
<div id="cache">
    <div id="aff_photo" class="row">
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
    $(function () {
        $("body").css("width", '99%');
        var i = true;
        var plusphoto = 1;
        var $window = $(window);
        var nbimage=Math.floor($window.width()/268);
        $window.scroll(function () {
            if ($window.height() + $window.scrollTop() == $(document).height()) {
                plusphoto++;
                ajax(plusphoto, nbimage);
            }
        });

        $(window).resize(function () {
            nbimage=Math.floor($window.width()/268);
        });

        if (i)
        {
            ajax(plusphoto, nbimage);
            i = false;
        }

    });
    function ajax(plusphoto, nbphoto) {
        $.post('photoPublic', {plus_photo: plusphoto}, function (data) {
            if (data != "") {
                var photos = jQuery.parseJSON(data);
                var i = 0;
                var j = 0
                taille = photos.length;
                while (i < taille) {
                    try {
                        if (j == 0)
                        {
                            $("#aff_photo").append("<div class ='row'>")
                        }
                        var nom = "./img/img_utilisateur/miniature/" + photos[i].nom_photo + '.' + photos[i].extension;
                        $("#aff_photo").append($('<img>', {
                            id: photos[i].nom_photo,
                            alt : "photo de "+photos[i].auteur ,
                            src: nom,
                            class: "img-thumbnail img-responsive"
                        }))
                        i++;
                        j++;
                        if (j==nbphoto)
                        {
                            $("#aff_photo").append("</div>");
                            j=0;
                        }
                    }
                    catch (err) {
                        alert("erreur lors de l'affichage des photos veuillez recharger la page");
                        break;
                    }
                }
            }
        });
    }
</script>
