<?php
session_start();
require_once 'inc/connect.php';

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
                        <li><a href="modificationProfile.php">Inscription</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- Fin du Menu -->

        <!-- Page -->
        <main class="container">
            <div class="row">

                <!-- contenu -->
                <?php foreach($statut_list as $value):?>

                    <div class="content">
                        <div class="col-sm-12">
                            <section id="partie1">
                                <p><i class="fa fa-user fa-3x" aria-hidden="true"> Publier par: <?= $value['UserLastName']; ?> <?= $value['UserFirstName']; ?></i></p>
                                <h3><?= $value['StatutTitle']; ?></h3>
                                
								<?php if(isset($value['StatutVideoUrl'])){
						
								?>
								
								<video>
								
									<source src="<?= $value['StatutVideoUrl']; ?>">
								
								</video>
								
								<?php
									}//Fin if StatutVideoUrl
									
								?>
								
								<p>
                                    <?= $value['StatutText']; ?>
                                </p>


                                <div class="pouce">

                                    <?php
									$select = $bdd->prepare('SELECT idStatut FROM statut INNER JOIN likestatus ON statut.idStatut=likestatus.Statut_idStatut WHERE idStatut=:idStatut LIMIT 3');
										$select->bindValue(':idStatut',$value['idStatut']);
										$select->execute()or die(print_r($select->errorInfo()));
									
									$like = $select->FetchAll(PDO::FETCH_ASSOC);
									
									if(count($like) > 0){
		
										echo count($like).'&nbsp;';
										
									}
								
								?>

                                        <i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>

                                </div>
                            </section>
                        </div>

                    </div>

                    <?php endforeach; ?>

                        <!-- Fin contenu -->
        </main>

        <!-- inclusion du fichier qui contient tous les script des pages -->
        <?php include 'inc/include-script.php';?>
    </body>

    </html>