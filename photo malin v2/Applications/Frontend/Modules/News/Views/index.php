<?php
?>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="img/logotest.png" alt="chat">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="img/logotest2.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
	  <div class="item">
      <img src="img/logotest3.jpg" alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 hidden-md hidden-lg ">
			<div class="jumbotron">
				<h1>attention</h1>
				<p>malheuresement il semble que vous surfez avec un ecran de petite taille, ce site est optimiser pour les grand ecran (992px ou plus) vous pouvez toujours profiter de ce site cependant vous pouriez avoir quelque problème d'affichage </p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="jumbotron">
				<h1>bienvenue sur photo malin</h1>
				<p>photo malin vous permettra d'avoirs accés à un grand nombre de photos de grande qualité pour usage commercial à un prix imbatable et peut être trouver la perle rare, mais aussi de proposer vos photos a la vente afin de pourquoi pas taper dans l'oeil d'un grand magazine. Et oui gagner de l'argent avec vos photo c'est possible</p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="jumbotron">
                        <h1><?php echo $news['titre']; ?></h1>
			<p class="auteur">Par <em><?php echo $news['auteur']; ?></em>, le <?php echo $news['dateAjout']->format('d/m/Y  H\hi'); ?></p>
                        <p><?php echo nl2br($news['contenu']); ?></p>
                        <p><a class="btn btn-primary btn-lg" role="button" href="news">Plus de news</a></p>
			</div>
		</div>	
	</div>
 </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="scripts/bootstrap.min.js"></script>
	<script>
$(function () {
   $('.carousel').carousel({ interval: 10000 });
   $('#0').click(function() { $('.carousel').carousel(0); });
   $('#1').click(function() { $('.carousel').carousel(1); });
   $('#2').click(function() { $('.carousel').carousel(2); });
});
</script>
  </body>
</html>