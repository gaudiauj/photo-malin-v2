
    $(function() {
	

	var i=true;
	//ajax
	var plusphoto=1;
	$('#plus_photo').click(function() {
	plusphoto++;
	$.post('gestion/aff_photo_public.php',{nom_triage: $("select[name='nom_triage'] > option:selected").val(),nom_recherche: $("select[name='nom_recherche'] > option:selected").val(),trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(),plus_photo: plusphoto }, function(data) {
	$('#aff_photo').html(data);
	if(!($('#invisible').html() === undefined))
	{	
	$('#plus_photo').css('display','none');
	}
	else
	{	
	$('#plus_photo').css('display','inline');
	}
    });    
	});
		if(i)
		{
			$.post('gestion/aff_photo_public.php',{nom_triage: $("select[name='nom_triage'] > option:selected").val(),nom_recherche: $("select[name='nom_recherche'] > option:selected").val(),trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(),plus_photo: plusphoto }, function(data) {
			$('#aff_photo').html(data);
			i=false;
			plusphoto=1;
			if(!($('#invisible').html() === undefined))
			{	
			$('#plus_photo').css('display','none');
			}
			else
			{	
			$('#plus_photo').css('display','inline');
			}
			});
		}
        $('select').mouseup(function() {
          $.post('gestion/aff_photo_public.php',{nom_triage: $("select[name='nom_triage'] > option:selected").val(),nom_recherche: $("select[name='nom_recherche'] > option:selected").val(),trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(),plus_photo: plusphoto }, function(data) {
		  $('#aff_photo').html(data);
		  plusphoto=1;
			if(!($('#invisible').html() === undefined))
			{	
			$('#plus_photo').css('display','none');
			}
			else
			{	
			$('#plus_photo').css('display','inline');
			}
          });    
        });
		$('#envoi').click(function() {
          $.post('gestion/aff_photo_public.php',{nom_triage: $("select[name='nom_triage'] > option:selected").val(),nom_recherche: $("select[name='nom_recherche'] > option:selected").val(),trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(),plus_photo: plusphoto }, function(data) {
		  $('#aff_photo').html(data);
		  plusphoto=1;
		  	if(!($('#invisible').html() === undefined))
			{	
			$('#plus_photo').css('display','none');
			}
			else
			{	
			$('#plus_photo').css('display','inline');
			}
          });    
        });
		$('#tri').keyup(function()
		{
		  $.post('gestion/aff_photo_public.php',{nom_triage: $("select[name='nom_triage'] > option:selected").val(),nom_recherche: $("select[name='nom_recherche'] > option:selected").val(),trier: $("select[name='trier'] > option:selected").val(), recherche: $("#recherche").val(),plus_photo: plusphoto }, function(data) {
		  $('#aff_photo').html(data);
		  plusphoto=1;
		  	if(!($('#invisible').html() === undefined))
			{	
			$('#plus_photo').css('display','none');
			}
          });  
		});
	//quand on clique sur l'image la met sur l'ecran avec overlay
	$('#aff_photo').on('click','img',function(){
		$('html').css('overflow','hidden');		
		var chemin=$(this).attr('src');
		$(this).parent().addClass('active');
		var texte='<div id="chargement"><p>chargement .... <img src="img/loading.gif"/></p></div><img id="img_aff" src=""/><div id="donnee"></div>';	 
		$('#tri').hide();
		//quand on click quitte l'affichage de l'image 
		$('#overlay').css('display','block').css('position','fixed').html(texte).on('click',function(){
			$('#tri').show();
			//quand on quitte l'affichage de l'image remise a zero
			$(this).css('display','none').css('position','relative');
			$('.active').removeClass('active');
			$('html').css('overflow','auto');
			$(document).off();
		});			 
		 // quand on presse un bouton
		$(document).keyup(function(e)
		{	 
		   if (e.which == 39) // Vers la droite
			{
				chemin=$('.active').next().find('img').attr('src');				
				// si chemin est defini sinon on doit aller a la ligne suivante
				if(chemin === undefined)
				{	
					chemin=$('.active').removeClass('active').parent().next().find(':first').addClass('active').find('img').attr('src');
						// si chemin est defini sinon on retourne au debut
						if(chemin === undefined)
						{
							$('.active').removeClass('active');
							chemin=$('tbody').find(':first').find(':first').addClass('active').find('img').attr('src');
						}
				}
				else
				{
					$('.active').removeClass('active').next().addClass('active');
				}
				affichage_photo(chemin);
			}
			if (e.which == 37) // Vers la droite
			{
				chemin=$('.active').prev().find('img').attr('src');
				if(chemin === undefined)
				{	
					chemin=$('.active').removeClass('active').parent().prev().find(':last-child').addClass('active').find('img').attr('src');
					// si chemin est defini sinon on retourne au debut
					if(chemin === undefined)
					{
						$('.active').removeClass('active');
						chemin=$('tbody').find(':last-child').find(':last-child').addClass('active').find('img').attr('src');
					}
				}
				else
				{
					$('.active').removeClass('active').prev().addClass('active');
				}
				affichage_photo(chemin);
			}
			
		});
		affichage_photo(chemin);
	  });
	});	
	// affiche la photo selectionner(chemin=source) et la redimensionne selon la taille de l'écran
	function affichage_photo(chemin)
	{      	
		var largeur_fenetre = $(window).width();
		var hauteur_fenetre = $(window).height();
		var chemin_normal=chemin.replace("miniature","taille_normal");
		var chemin_700=chemin.replace("miniature","700");
		var source=chemin_normal;
		var theImage = new Image();
		theImage.src = source;
		$('#donnee').html('<p> <a href="'+chemin_700+'"> photo 700px<a/>    ||    <a href="'+chemin_normal+'"> photo taille normal<a/><br /> '+$('.active').find('.donnee :first').html()+'</p>');
		$('#img_aff').css('display','none').attr('src',source).attr('id',"img_aff");	
		$('#chargement').css('display','inline');
		
		// on attend que l'image se charge et on l'affiche a la taille de l'ecran
		$('#img_aff').load(function()
		{
			
			$(this).css('display','inline');
			$('#chargement').css('display','none');
			
			// creation d'un objet image pour avoir la taille de l'image	
	
			var imageWidth = theImage.width;
			var imageHeight = theImage.height;			
			
			//redimensionnement de l'image selon l'ecran
			$('#chargement').css('display','none');
			$(this).css('display','inline');
			var redimensionner=false;				
			if(imageWidth > largeur_fenetre-200)
			{
				var ratio=imageWidth / imageHeight;
				var nouveau_w = largeur_fenetre-200;
				var nouveau_h= nouveau_w / ratio;
				if(nouveau_h > hauteur_fenetre-250)
					{
						nouveau_h=hauteur_fenetre-250;
						nouveau_w= nouveau_h * ratio;
					}
				$(this).css('width',nouveau_w).css('height',nouveau_h);
				redimensionner=true;					
			}
			else if(imageHeight > hauteur_fenetre-250 && redimensionner == false)
			{
				var ratio=imageWidth / imageHeight;
				var nouveau_h = hauteur_fenetre-250;
				var nouveau_w= nouveau_h * ratio;
				$(this).css('width',nouveau_w).css('height',nouveau_h);
			}
			else
			{
				$(this).css('width',imageWidth).css('height',imageHeight);
			}
		});
   }