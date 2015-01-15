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
        var photo = new Array();
        var $window = $(window);
        $window.scroll(function () {
            if ($window.height() + $window.scrollTop() == $(document).height()) {
                plusphoto++;
                ajax(plusphoto);
            }
        });
        if (i)
        {
            ajax(plusphoto);
            i = false;
        }

        $('#aff_photo').on('click', 'img', function () {
            $('#tri').hide();
            $('html').css('overflow', 'hidden');
            var chemin = $(this).attr('src');
            $(this).addClass('active');
            var texte = '<div id="chargement"><p>chargement .... <img src="img/loading.gif"/></p></div><img id="img_aff" src=""/><div id="donnee"></div>';
            var donnee = $(this).data("auteur");
            //quand on click quitte l'affichage de l'image
            $('#overlay').css('display', 'block').css('position', 'fixed').html(texte).on('click', function () {
                quitter_overlay()
            });
            // quand on presse un bouton
            $(document).keyup(function (e)
            {
                if (e.which == 39) // Vers la droite
                {
                    image_suivante_droite()
                }
                if (e.which == 37) // Vers la droite
                {
                    image_suivante_gauche()
                }
                if (e.which == 27) // quand on appuie sur echap on quitte
                {
                    quitter_overlay()
                }
            });
            affichage_photo(chemin,donnee);
        });

    });
    function ajax(plusphoto) {
        $.post('photoPublic', {plus_photo: plusphoto}, function (data) {

                var photos = jQuery.parseJSON(data);
                if (photos != null) {
                    var i = 0;
                    taille = photos.length;
                    while (i < taille) {
                        try {
                            var nom = "./img/img_utilisateur/miniature/" + photos[i].nom_photo + '.' + photos[i].extension;
                            $("#aff_photo").append($('<img>', {
                                id: photos[i].nom_photo,
                                alt: "photo de " + photos[i].auteur,
                                src: nom,
                                class: "img-thumbnail img-responsive",
                                'data-auteur': photos[i].auteur,
                                'data-titre': photos[i].titre,
                                'data-appareil_photo': photos[i].exif.appareil_photo,
                                'data-focale': photos[i].exif.focale,
                                'data-iso': photos[i].exif.iso,
                                'data-vit_obt': photos[i].exif.vit_obt,
                                'data-date_prise_photo': photos[i].exif.date_prise_photo.date
                            }))
                            i++;
                        }
                        catch (err) {
                            alert("erreur :"+err+" lors de l'affichage des photos veuillez recharger la page");
                            break;
                        }
                    }
                }
        });
    }

    function image_suivante_gauche()
    {
        photo = $('.active').removeClass('active').prev().addClass('active');
        chemin = photo.attr('src');
        donnee["auteur"] = photo.data("auteur")
        if (chemin === undefined)
        {
            $('.active').removeClass('active');
            chemin = $('#aff_photo img').last().addClass('active').attr('src');
        }
        affichage_photo(chemin, donnee);
    }

    function image_suivante_droite()
    {
        photo = $('.active').removeClass('active').next().addClass('active');
        chemin = photo.attr('src');
        donnee["auteur"] = photo.data("auteur")
        if (chemin === undefined)
        {
            $('.active').removeClass('active');
            chemin = $('#aff_photo img').first().addClass('active').attr('src');
        }
        affichage_photo(chemin, donnee);
    }

    function quitter_overlay()
    {
        $('#tri').show();
        $('#overlay').css('display', 'none').css('position', 'relative');
        $('.active').removeClass('active');
        $('html').css('overflow', 'auto');
        $(document).off();
    }

    // affiche la photo selectionner(chemin=source) et la redimensionne selon la taille de l'écran
    function affichage_photo(chemin, donnee)
    {
        var largeur_fenetre = $(window).width();
        var hauteur_fenetre = $(window).height();
        var chemin_normal = chemin.replace("miniature", "taille_normal");
        var chemin_700 = chemin.replace("miniature", "700");
        var source = chemin_normal;
        var theImage = new Image();
        theImage.src = source;

        $('#img_aff').css('display', 'none').attr('src', source).attr('id', "img_aff");
        $('#chargement').css('display', 'inline');

        // on attend que l'image se charge et on l'affiche a la taille de l'ecran
        $('#img_aff').load(function ()
        {
            $(this).css('display', 'inline');
            $('#chargement').css('display', 'none');

            // creation d'un objet image pour avoir la taille de l'image
            var imageWidth = theImage.width;
            var imageHeight = theImage.height;

            //redimensionnement de l'image selon l'ecran
            $('#chargement').css('display', 'none');
            $(this).css('display', 'inline');
            var redimensionner = false;
            if (imageWidth > largeur_fenetre - 200)
            {
                var ratio = imageWidth / imageHeight;
                var nouveau_w = largeur_fenetre - 200;
                var nouveau_h = nouveau_w / ratio;
                if (nouveau_h > hauteur_fenetre - 250)
                {
                    nouveau_h = hauteur_fenetre - 250;
                    nouveau_w = nouveau_h * ratio;
                }
                $(this).css('width', nouveau_w).css('height', nouveau_h);
                redimensionner = true;
            }
            else if (imageHeight > hauteur_fenetre - 250 && redimensionner == false)
            {
                var ratio = imageWidth / imageHeight;
                var nouveau_h = hauteur_fenetre - 250;
                var nouveau_w = nouveau_h * ratio;
                $(this).css('width', nouveau_w).css('height', nouveau_h);
            }
            else
            {
                $(this).css('width', imageWidth).css('height', imageHeight);
            }
        });
    }


</script>
