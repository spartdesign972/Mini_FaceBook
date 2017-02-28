<?php
session_start();

$errors = [];

if(!empty($_POST)){
	
	foreach($_POST as $key => $value){
		
		$post[$key] = $value; 
		
	}
	
	if(count($errors) == 0){
		
		require_once 'inc/connect.php';
			
		$select = $bdd->prepare('INSERT INTO statut( StatutTitle, StatutPictureUrl, StatutVideoURL, StatutText, StatutDatePublication, Users_idUsers) VALUES (:StatutTitle, :StatutPictureUrl, :StatutVideoURL, :StatutText, :StatutDatePublication, :Users_idUsers)');
			
			$select->bindValue(':StatutTitle',$post['StatutTitle']);
			
			$select->bindValue(':StatutPictureUrl',$post['StatutPictureUrl']);
			
			$select->bindValue(':StatutVideoURL',$post['StatutVideoURL']);
			
			$select->bindValue(':StatutText',$post['StatutText']);
			
			$select->bindValue(':StatutDatePublication',$post['StatutDatePublication']);
			
			$select->bindValue(':Users_idUsers',$_SESSION['idUser']);
			
		$select->execute() or die(print_r($insert->errorInfo()));;;
		var_dump($select);
	}//Fin de errors=0
}//Fin de !empty($_POST)
?><!DOCTYPE html>
    <html lang="fr">


    <head>
        <meta charset="UTF-8">
        <title>Plublication</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
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
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="publicationTrade.php">Les Postes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="modificationProfile.php">Mon Profile</a></li>
                        <li><a href="confirmLogout.php">Logout</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <div class="container">
            <!-- sidebar -->
            <?php require_once 'inc/sidebar.php'; ?>
            
            <div class="content">
                <!-- En-Tête de Présentation -->
                <div class="pageTitle text-center">
                    <h1>Publier</h1>
                </div>
                
                <!-- Début Formulaire -->
                    <form id="publier" class="form-horizontal" method="post" enctype="multipart/form-data" role="form" data-toggle="validator">
                        <!-- Titre de la publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="title" name="title" type="text" placeholder="Titre de la publication" class="form-control">
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="picture" name="picture" type="file" placeholder="Image à la une" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <br>
                        <p><strong>OU</strong></p>
                        <br>
                        <!-- Url Video -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input id="UrlVideo" name="UrlVideo" type="text" placeholder="Entrez l'Url d'une video" class="form-control">
                            </div>
                        </div>
                        <!-- Publication -->
                        <div class="form-group">
                            <div class="col-xs-12">
                                <textarea class="form-control" rows="15" id="comment" placeholder="Publier"></textarea>

                            </div>
                        </div>
                        <!-- Bouton d'Envoi -->
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <button type="submit" class="btn btn-primary" name="inscription" value="Publier ma demande">Publier</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        <!-- Fin Formulaire -->
    </div>
    </main>
    <!-- inclusion du fichier qui contient tous les script des pages -->
    <?php include 'inc/include-script.php';?>
</body>
</html>