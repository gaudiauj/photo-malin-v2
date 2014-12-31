
$(function () {

    // calcul et affichage des photo en fonction de la taille de l'ecran de l'utilisateur
    var nb_photo_ligne = Math.floor($(window).width() / 250);
    $(window).resize(function () {
        ancien_nb_photo_ligne = nb_photo_ligne;
        nb_photo_ligne = Math.floor($(window).width() / 250);
        if (ancien_nb_photo_ligne != nb_photo_ligne)
        {
            ajax();
        }
    });


    var i = true;
    var plusphoto = 1;
    var $window = $(window);

    // chargement de nouvelle image quand on est en bas de la page
    $window.scroll(function () {
        if ($window.height() + $window.scrollTop() >= $(document).height() - 1) {
            plusphoto++;
            ajax();
        }
    });

    if (i)
    {
        ajax();
        i = false;
        plusphoto = 1;
    }
    $('select').mouseup(function () {
        ajax();
        plusphoto = 1;
    });
    $('#envoi').click(function () {
        ajax();
        plusphoto = 1;
    });
    $('#tri').keyup(function ()
    {
        ajax();
        plusphoto = 1;
    });
    //quand on clique sur l'image la met sur l'ecran avec overlay
    $('#aff_photo').on('click', 'img', function () {
        $('#tri').hide();
        $('html').css('overflow', 'hidden');
        var chemin = $(this).attr('src');
        $(this).parent().addClass('active');
        var texte = '<div id="chargement"><p>chargement .... <img src="img/loading.gif"/></p></div><img id="img_aff" src=""/><div id="donnee"></div>';

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
        affichage_photo(chemin);
    });

    function image_suivante_gauche()
    {
        chemin = $('.active').prev().find('img').attr('src');
        if (chemin === undefined)
        {
            chemin = $('.active').removeClass('active').parent().prev().find(':last-child').addClass('active').find('img').attr('src');
            // si chemin est defini sinon on retourne au debut
            if (chemin === undefined)
            {
                $('.active').removeClass('active');
                chemin = $('#boss').find(':last-child').find(':last-child').addClass('active').find('img').attr('src');
            }
        }
        else
        {
            $('.active').removeClass('active').prev().addClass('active');
        }
        affichage_photo(chemin);
    }

    function image_suivante_droite()
    {
        chemin = $('.active').next().find('img').attr('src');
        // si chemin est defini sinon on doit aller a la ligne suivante
        if (chemin === undefined)
        {
            chemin = $('.active').removeClass('active').parent().next().find(':first').addClass('active').find('img').attr('src');
            // si chemin est defini sinon on retourne au debut
            if (chemin === undefined)
            {
                $('.active').removeClass('active');
                chemin = $('#first').find(':first').addClass('active').find('img').attr('src');
            }
        }
        else
        {
            $('.active').removeClass('active').next().addClass('active');
        }
        affichage_photo(chemin);
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
    function affichage_photo(chemin)
    {
        var largeur_fenetre = $(window).width();
        var hauteur_fenetre = $(window).height();
        var chemin_normal = chemin.replace("miniature", "taille_normal");
        var chemin_700 = chemin.replace("miniature", "700");
        var source = chemin_normal;
        var theImage = new Image();
        theImage.src = source;
        $('#donnee').html('<p> <a href="' + chemin_700 + '"> photo 700px<a/>    ||    <a href="' + chemin_normal + '"> photo taille normal<a/><br /> ' + $('.active').find('.donnee :first').html() + '</p>');
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


    function ajax() {
        $.post('gestion/aff_photo_test.php', {nom_triage: $("select[name='nom_triage'] > option:selected").val(), nom_recherche: $("select[name='nom_recherche'] > option:selected").val(), trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(), plus_photo: plusphoto, photo_ligne: nb_photo_ligne, privee: 'privee'}, function (data) {
            $('#aff_photo').html(data);
        });
    }
});