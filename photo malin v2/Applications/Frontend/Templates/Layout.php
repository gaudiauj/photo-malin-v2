
<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta name="keywords" content="photo, malin, polkach, droit d'auteur, vendre photo, acheter photo,photo malin" />
        <meta name="description" content="photo malin vous permettra d'avoirs accés à un grand nombre de photos de grande qualité pour usage commercial à un prix imbatable et peut être trouver la perle rare, mais aussi de proposer vos photos a la vente afin de pourquoi pas taper dans l'oeil d'un grand magazine. Et oui gagner de l'argent avec vos photo c'est possible" />
        <title> <?php echo($title); ?></title>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/test.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
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
                        <li class=" hidden-md hidden-sm"><a href="index.php?page=accueil">Accueil</a></li>
                        <li class=""><a href="inscrire.php?page=inscription">S'inscrire</a></li>
                        <li class=""><a href="chat.php?page=chat">Chat</a></li>
                        <li class="" ><a href="photo.php?page=photos">photos</a></li>
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

                        <?php
                        if ($this->app->user()->isAuthenticated()) {
                            ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="http://localhost/jeantest/web/admin/news-page-1">News</a></li>
                                    <li><a href="http://localhost/jeantest/web/admin/news-insert">insert news</a></li>
                                     <li><a href="http://localhost/jeantest/web/admin/comment-list-page-1">liste commentaire</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li class="divider"></li>
                                    <li><a href="http://localhost/jeantest/web/admin/deco">deconnexion</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right hidden-md hidden-lg hidden-xs ">
                        <li class="" ><a href="se_connecter.php?page=connexion">se connecter</a></li>
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
        <div class="container-fluid">
        <?php echo $content; ?>
            </div>
    </body>
</html>
