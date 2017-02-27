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

        <!-- Pour Internet Explorer : S'assurer qu'il utilise la dernière version du moteur de rendu -->
        <meta http-equiv="X-UA-Compatible" content="IE-edge">

        <!-- Affichage sans zoom pour les mobiles -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Styles CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shiv -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js" integrity="sha256-sqQlcOZwgKkBRRn5WvShSsuopOdq9c3U+StqgPiFhHQ=" crossorigin="anonymous"></script>

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
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Mon Profile</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>


        <main class="container">

            <h2>Bonjour</h2>

            <section class="row">
                <!-- En-Tête de Présentation -->
                <div class="contact col-xs-12">
                    <h1>Publier</h1>
                </div>




            </section>

            <section class="row">


                <div class="comment col-sm-4">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object photo-profile" src="./assets/img/<?=$_SESSION['UserAvatar'];?>" width="100" height="100" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="#" class="anchor-username"><h4 class="media-heading"><?=$_SESSION['lastname']; ?></h4></a>
                            <a href="#" class="anchor-time"><?=$_SESSION['firstname']; ?></a>
                        </div>
                    </div>
                </div>

                <!-- Début Formulaire -->
                <div class="col-sm-8">
                    <form id="contact" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <fieldset>

                            <!-- Titre de la publication -->
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input id="title" name="StatutTitle" type="text" placeholder="Titre de la publication" class="form-control input-md">
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input id="picture" name="StatutPictureUrl" type="file" placeholder="Image à la une" accept="image/*" class="form-control input-md">
                                </div>
                            </div>

                            <br>
                            <p><strong>OU</strong></p>
                            <br>

                            <!-- Url Video -->
                            <div class="form-group">

                                <div class="col-md-8">
                                    <input id="UrlVideo" name="StatutVideoURL" type="text" placeholder="Entrez l'Url d'une video" class="form-control input-md">
                                </div>
                            </div>
                            <!-- Publication -->
                            <div class="form-group">
                                <div class="col-md-8">

                                    <textarea class="form-control" rows="15" id="comment" name="StatutText" placeholder="Publier"></textarea>
                                </div>
                            </div>


                            <!-- Bouton d'Envoi -->
                            <div class="form-group">
                                <div class="<col-md-7></col-md-7> col-xs-offset-4">
                                    <button type="submit" class="btn btn-primary" name="inscription" value="Ajouter le Contact">Publier</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>

                <!-- /.col-sm-6 -->
                <!-- Fin Formulaire -->

            </section>
        </main>







        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>

    </html>