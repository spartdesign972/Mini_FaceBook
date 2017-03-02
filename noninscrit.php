<?php
session_start();
require_once 'inc/connect.php';
include 'inc/youtuburl.php';

	$statut = $bdd->prepare('SELECT * FROM statut INNER JOIN users ON statut.Users_idUsers=users.idUser LIMIT 3');	
		$statut->execute();
		$statut_list = $statut->FetchAll(PDO::FETCH_ASSOC);
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Non Inscrit</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
            <link rel="stylesheet" type="text/css" href="assets/css/publication.css">
    </head>

    <body>

        <!-- Menu -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- Gestion du Menu Burger : Version Mobile -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WF3 Mini FaceBook</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="suscribe.php">Inscription</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- Fin du Menu -->

        <!-- Page -->
        <main class="container">
            <div class="row noninscrit">

                <!-- contenu -->
            <div class="content">
                <div class="col-xs-12 col-xs-offset-2">
                    
                    <?php foreach($statut_list as $value):?>
                    
                    <section id="partie1">
                        <div class='headpost'>
                            <?php if(!empty($value['UserAvatar'])){ ?>
                            <img src="./uploads/<?php echo $value['UserAvatar']; ?>" alt="" height=70>
                            <?php }else{ echo '<i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>'; } ?>
                        <h3> Publier par: </h3>
                        <h2><?= $value['UserLastName']; ?> <?= $value['UserFirstName']; ?></h2>
                        </div>
                        <div class="clear"></div>
                        <hr class="posthr">
                        <h3 class='posttitle'><?= $value['StatutTitle']; ?></h3>

                        <?php if(!empty($value['StatutVideoURL'])){ ?>  
                        <div class="row text-center">
                            <?php
                                $videourl = getYoutubeEmbedUrl($value['StatutVideoURL']);
                            ?>
                            <iframe width="650" height="400" src="https://www.youtube.com/embed/<?=$videourl ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <?php 
                        }else{
                            echo '<div class="row text-center">';
                            echo '<img src="'.$value['StatutPictureUrl'].'" alt="image poste"/>';
                            echo '</div>';
                        }
                        ?>

                        
                        <p><?= $value['StatutText']; ?></p>
                        
                    </section>
            <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Fin contenu -->
            </main>
            
            <!-- Fin de Page -->
            <!-- inclusion du fichier qui contient tous les script des pages -->
            <?php include 'inc/include-script.php';?>
        </body>l
    </html>