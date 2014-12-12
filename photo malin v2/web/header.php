<?php 
include("gestion/sessionstart.php");
?>
<?php

$title = $_GET['page'];
//on enleve les %20 par des espaces
$title = str_replace( '%20', ' ',$title);

?>

<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="UTF-8">
	<meta name="keywords" content="photo, malin, polkach, droit d'auteur, vendre photo, acheter photo,photo malin" />
	<meta name="description" content="photo malin vous permettra d'avoirs accés à un grand nombre de photos de grande qualité pour usage commercial à un prix imbatable et peut être trouver la perle rare, mais aussi de proposer vos photos a la vente afin de pourquoi pas taper dans l'oeil d'un grand magazine. Et oui gagner de l'argent avec vos photo c'est possible" />
    <title> <?php if (empty($title)){ echo 'photo malin';}else {echo $title;}?></title>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/test.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="scripts/connexion_nav.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php if(empty($_SESSION['pseudo']))
{?>
   <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?page=accueil">Photo malin</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if ($title=="accueil"){ echo 'active';} ?> hidden-md hidden-sm"><a href="index.php?page=accueil">Accueil</a></li>
			<li class="<?php if ($title=="inscription"){ echo 'active';} ?>"><a href="inscrire.php?page=inscription">S'inscrire</a></li>
			<li class="<?php if ($title=="chat"){ echo 'active';} ?>"><a href="chat.php?page=chat">Chat</a></li>
			<li class="<?php if ($title=="photos"){ echo 'active';} ?>" ><a href="photo.php?page=photos">photos</a></li>
          <!--  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">photo <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<li class="dropdown-header">photos</li>
                <li><a href="photo.php?page=photos">photos public</a></li>
                <li><a href="#">mes photos</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>		
              </ul>
            </li>-->	
			<li><a href="mailto:gaudiauj@gmail.com">Me contacter</a></li>
          </ul>
		  	<ul class="nav navbar-nav navbar-right hidden-md hidden-lg hidden-xs ">
			<li class="<?php if ($title=="connexion"){ echo 'active';} ?>" ><a href="se_connecter.php?page=connexion">se connecter</a></li>
			</ul>
          <ul class="nav navbar-nav navbar-right hidden-sm">
            <li> <form class="navbar-form navbar-left" >
		<input type="text" class="form-control" id="pseudo_nav" placeholder="pseudo"> </form>
		</li>
		
            <li><form class="navbar-form navbar-left" > <input type="password" id="nav_pass" class="form-control" placeholder="mot de passe"></form> </li>
            <li> <button type="button" id="nav_connexion" class="btn btn-default">Connexion</button></li>
			
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	<?php 
}
else
{
?>
   <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?page=accueil">Photo malin</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php if ($title=="accueil"){ echo 'active';} ?> hidden-sm "><a href="index.php?page=accueil">Accueil</a></li>
			<li class="<?php if ($title=="chat"){ echo 'active';} ?>"><a href="chat.php?page=chat">Chat</a></li>
			<li class="<?php if ($title=="photos"){ echo 'active';} ?>"><a href="photo.php?page=photos">photos</a></li>
			<li class="<?php if ($title=="mes photos"){ echo 'active';} ?>"> <a href="mes_photos.php?page=mes%20photos">mes photos</a></li>
			<li class="<?php if ($title=="envoyer photos"){ echo 'active';} ?>" ><a class="hidden-sm" href="envoitest.php?page=envoyer%20photos" title="envoyer photo">envoyer photo</a></li>
			
          <!--  <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">mon compte <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<li class="dropdown-header">mon compte</li>
                <li><a href=" mon_compte.php">mon compte</a></li>                
                <li class="divider"></li>
                <li class="dropdown-header">photos</li>
                <li><a href="mes_photos.php?page=mes%20photos">mes photos</a></li>	
              </ul>
            </li>-->	
			<li><a href="mailto:gaudiauj@gmail.com">Me contacter</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			<li id="nom_nav"> <?php
echo (stripslashes(htmlentities($_SESSION['pseudo'], ENT_QUOTES,'UTF-8')));echo(' : </li>');
?><li class="dropdown">
              <a href="mon_compte.php" class="dropdown-toggle" data-toggle="dropdown">mon compte <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<li class="dropdown-header">mon compte</li>
                <li><a href=" mon_compte.php">mon compte</a></li>                
                <li class="divider"></li>
                <li class="dropdown-header">photos</li>
                <li><a href="mes_photos.php?page=mes%20photos">mes photos</a></li>	
              </ul>
            </li>
            <li> <form method="post" action="gestion/deco.php" id="deco" enctype="multipart/form-data"><button type="submit" id="nav_deconnexion" class="btn btn-default">Deconnexion</button></form></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
 <?php
 }
 ?>