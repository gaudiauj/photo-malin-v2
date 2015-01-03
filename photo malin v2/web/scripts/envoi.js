
function upload(files, fichier)
{
    var m = 0;
    var taille_files = files.length;
    var f = files[0];
    var files_renvoyer = new Array;
    // seulement si c'est une image 
    if (!f.type.match('image'))
    {
        alert('le fichier doit etre une image');
        return false;
    }
    var reader = new FileReader();
    reader.onload = handleReaderLoad;
    reader.readAsDataURL(f);
    fichier.append('fichier', f);
    if (taille_files > 1)
    {
        while (m + 1 < taille_files)
        {
            files_renvoyer[m] = files[m + 1];
            m++;

        }
        return files_renvoyer;
    }
    else
    {
        return null;
    }

}



// redimensionne une image pour creer une miniature	et l'affiche		
function redim_image(imagepreview)
{
    var ratio = imagepreview.width / imagepreview.height;
    var miniature_w = 140;
    var miniature_h = miniature_w / ratio;
    var preview_w = 340;
    var preview_h = preview_w / ratio;
    $('#preview').attr('src', imagepreview.src).css('width', preview_w).css('height', preview_h);
}



function handleReaderLoad(evt)
{
    var imagepreview = new Image();
    imagepreview.src = evt.target.result;
    redim_image(imagepreview);
    $("#guillaumedaix").dialog({width: 550});
    $("#guillaumedaix").parent().css('left', '600px');
}



// gestion des bug de jquery ui		
if (!$.isFunction($.fn.curCSS))
{
    $.curCSS = $.css;
    $.fn.curCSS = $.fn.css;
    var mouseY, lastY = 0;
}
jQuery.browser = {};
(
        function () {
            jQuery.browser.msie = false;
            jQuery.browser.version = 0;
            if (navigator.userAgent.match(/MSIE ([0-9]+)\./))
            {
                jQuery.browser.msie = true;
                jQuery.browser.version = RegExp.$1;
            }
        })();



// on regarde la photo et l'affiche
function readURL(input) {
    if (input.files && input.files[0])
    {
        var reader2 = new FileReader();
        reader2.onload = function (e)
        {
            var imagepreview = new Image();
            imagepreview.src = e.target.result;
            redim_image(imagepreview)
        }
        reader2.readAsDataURL(input.files[0]);
    }
}


$(document).ready(function (e)
{
    var files_renvoyer = new Array;
    var selected_file;
    var fichier = new Array;
    var i = 0;
    var j = 0;
    var myXhr = new Array;
    var unefois = true;
    fichier[i] = new FormData();
    $("#guillaumedaix").hide();


    //gestion du drag and dropp
    $(document).on('dragenter', '#dropfile', function ()
    {
        $(this).css('border', '3px dashed red');
        return false;
    });

    $(document).on('dragover', '#dropfile', function (e)
    {
        e.preventDefault();
        e.stopPropagation();
        $(this).css('border', '3px dashed #BBBBBB');
        return false;
    });

    $(document).on('dragleave', '#dropfile', function (e)
    {
        e.preventDefault();
        e.stopPropagation();
        return false;
    });


    function ajax()
    {
        myXhr[j] = $.ajaxSettings.xhr();
        if ((myXhr[j].upload))
        {
            $.ajax({
                url: "ajout",
                type: "POST",
                data: fichier[j],
                contentType: false,
                cache: false,
                xhr: function ()
                {
                    if (myXhr[j].upload)
                    {
                        myXhr[j].upload.addEventListener('progress', function (event) {
                            if (event.lengthComputable) {
                                $('.progress' + j).show();
                                $("progress").val(((event.loaded / event.total) * 100));
                                $(".percents" + j).html(" " + ((event.loaded / event.total) * 100).toFixed() + "%");
                                $(".up-done").html((parseInt(event.loaded / 1024)).toFixed(0));
                                if ((event.loaded / event.total) == 1)
                                {
                                    $(".percents" + j).html('<span class="white">patientez creation de la miniature ... <img src="img/loading.gif"/></span>');
                                }
                            }
                        }, false);
                    }
                    return myXhr[j];
                },
                processData: false,
                dataType: "html",
                success: function (data)
                {
                    alert(data);
                    $(".percents" + j).html(data);
                    $('.progress' + j).hide();
                    j = j + 1;
                    if (j < i)
                    {
                        ajax();
                    }
                    else
                    {
                        unefois = true;
                    }
                    $('#message').html("<p>transfert" + j + "reussi</p>");
                },
                error: function (data) {
                    $(".percents" + j).html("erreur veuillez recharger la page");
                    $(".percents" + j).html(data);
                    $("erreur").html(data);
                }
            });
        }
    }


    //quand on drag une image dans la zone
    $(document).on('drop', '#dropfile', function (e) {
        if (e.originalEvent.dataTransfer)
        {
            if (e.originalEvent.dataTransfer.files.length)
            {
                e.preventDefault();
                e.stopPropagation();
                files_renvoyer = upload(e.originalEvent.dataTransfer.files, fichier[i]);
            }
        }
        else {
            $(this).css('border', '3px dashed #BBBBBB');
        }
        return false;
    });

    // quand on change de fichier on fait apparaitre la fenetre avec le form
    $("#fichier").change(function () {
        selected_file = $(this).get(0).files[0];
        fichier[i].append('fichier', selected_file);
        $("#guillaumedaix").dialog({width: 550});
        $("#guillaumedaix").parent().css('left', '600px');
        $("#guillaumedaix").show();
        readURL(this);
    });

    // quand on valide le formulaire on envoi le tout via ajax
    $("#uploadForm").on('submit', (function (e)
    {
        e.preventDefault();
        if ($('input:checked').val() === undefined)
        {
            alert('vous devez specifier si la photo doit etre privée ou public !');
        }
        else
        {
            var miniature = new Image();
            miniature.src = $('#preview').attr('src');
            $("#prev").append(miniature);
            $("#prev").append('<span class="white percents' + i + '">transfert en attente des transfert precedent</span>').append('<progress class="progress' + i + '"value="0" min="0" max="100">progression</progress><br />');
            $('.progress' + i).hide();
            $("#guillaumedaix").dialog('close');
            var other_data = $(this).serializeArray();
            $.each(other_data, function (key, input) {
                fichier[i].append(input.name, input.value);
            });
            i++;
            fichier[i] = new FormData();
            if (unefois)
            {
                unefois = false;
                ajax();
            }
            // reset du formulaire
            $('#guillaumedaix').find('form')[0].reset();
            //gere le multi upluoad
            if (files_renvoyer != null)
            {
                files_renvoyer = upload(files_renvoyer, fichier[i]);
            }

        }

    }));
});
