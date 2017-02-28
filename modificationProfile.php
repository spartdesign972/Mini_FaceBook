<?php

session_start();

$errors = [];

require_once 'inc/connect.php';

	$user = $bdd->prepare('SELECT * FROM users WHERE 	idUser=:idUser');
	$user->bindValue(':idUser',$_SESSION['idUser'],PDO::PARAM_INT);
	$user->execute();
	$user = $user->Fetch(PDO::FETCH_ASSOC);

if(!empty($_POST)){
	
	foreach($_POST as $key => $value){
		
		$post[$key] = $value; 
		
	}
	
	if(count($errors) === 0){
		
		require_once 'inc/connect.php';
		
		$update = $bdd->prepare('UPDATE users SET UserLastName=:UserLastName, UserFirstName=:UserFirstName, UserEmail=:UserEmail, UserBirtday=:UserBirtday, UserAvatar=:UserAvatar, UserDescription=:UserDescription WHERE 	idUser=:idUser)');
			
			$update->bindValue(':UserLastName',$post['UserLastName']);

			$update->bindValue(':UserFirstName',$post['UserFirstName']);
			
			$update->bindValue(':UserEmail',$post['UserEmail']);

			$update->bindValue(':UserBirtday',$post['UserBirtday']);

			$update->bindValue(':UserAvatar',$post['UserAvatar']);

			$update->bindValue(':UserDescription',$post['UserDescription']);
			
			$update->bindValue(':idUser',$_SESSION['idUser'],PDO::PARAM_INT);

		$update->execute() or die(print_r($update->errorInfo()));;
		
	}//Fin de errors=0
}//Fin de !empty($_POST)
	
?><!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modification Profile</title>

    
    <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
    <?php include 'inc/include-head.php';?>

    <link rel="stylesheet" type="text/css" href="assets/css/modification.css">
    
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
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="publicationTrade.php">Les Postes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#">Mon Profile</a></li> -->
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- Fin du Menu -->


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <section id="modification">

                    <!-- Choix image -->
                    <div class="image">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image de profil</label>
                                    <input type="file" name="UserAvatar" id="exampleInputFile">
                                </div>
                            </div>

                            <div class="col-xs-4">
                  
								<img src="./assets/img/<?=$_SESSION['UserAvatar']; ?>" class="img-responsive img-circle" alt="Image Avatar">
			
                            </div>
                        </div>
                    </div>

                    <!-- Début Formulaire -->
                    <form id="modification" class="form-horizontal" action="#" method="post" role="form" data-toggle="validator">

                        <!-- Nom -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="nom" name="UserLastName" required class="form-control" data-error="N'oubliez pas de saisir votre nom" type="text" value="<?=$user['UserLastName'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Prénom -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="prenom" name="UserFirstName" required class="form-control" data-error="N'oubliez pas de saisir votre prenom" type="text" value="<?=$user['UserFirstName'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <input id="email" name="UserEmail" required class="form-control" data-error="N'oubliez pas de saisir votre email" type="email" value="<?=$user['UserEmail'];?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Date de Naissance -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="date de naissance" name="UserBirtday" required class="form-control" data-error="N'oubliez pas de saisir votre date de naissance" type="text" value="<?=$user['UserBirtday'];?>">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
						
						<!-- Textarea ne supporte pas l'attribut value -->
                        <!-- Description -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <textarea id="description" name="UserDescription" rows="5" value="<?=$user['UserDescription'];?>" class="form-control"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Bouton d'Envoi -->
                        <div class="col-xs-12">
                            <div class="form-group has-feedback">
                                <input type="submit" class="btn btn-primary" name="contact" value="Envoyer ma Demande"><!--Modifier</button>--> 
                            </div>
                        </div>

                    </form>
                </section>
            </div>
        </div>
    </div>


   <!-- inclusion du fichier qui contient tous les script des pages -->
    <?php include 'inc/include-script.php';?>

    <script>
        // -- Initialisation de jQuery
        $(function () {

            $('#modification').validator().on('submit', function (e) {

                if (!e.isDefaultPrevented()) {
                    $(this).replaceWith('<div class="alert alert-success">Votre Modification à bien été effectuer.</div>');
                }

                return false;

            });

        });
    </script>

</body>

</html>