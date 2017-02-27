<?php
//session_start();

$errors = [];	

if(!empty($_POST)){
	
	foreach($_POST as $key => $value){
		
		$post[$key] = $value; 
		
	}
	
	if(count($errors) === 0){
		
		require_once 'inc/connect.php';
		
		$insert = $bdd->prepare('INSERT INTO users( UserLastName, UserFirstName, UserEmail, UserPassword, UserBirtday, UserGender, UserAvatar, UserDescription, UserSubscribeDate) VALUES ( :UserLastName, :UserFirstName, :UserEmail, :UserPassword, :UserBirtday, :UserGender, :UserAvatar, :UserDescription, :UserSubscribeDate)');
			
			$insert->bindValue(':UserLastName',$post['UserLastName']);

			$insert->bindValue(':UserFirstName',$post['UserFirstName']);
			
			$insert->bindValue(':UserEmail',$post['UserEmail']);
			
			$insert->bindValue(':UserPassword',$post['UserPassword']);

			$insert->bindValue(':UserBirtday',$post['UserBirtday']);

			$insert->bindValue(':UserGender',$post['UserGender']);

			$insert->bindValue(':UserAvatar',$post['UserAvatar']);

			$insert->bindValue(':UserDescription',$post['UserDescription']);

			$insert->bindValue(':UserSubscribeDate',$post['UserSubscribeDate']);
		
		$insert->execute() or die(print_r($insert->errorInfo()));;
		
	}//Fin de errors=0
}//Fin de !empty($_POST)

?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Inscription</title>
	<!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
	<?php include 'inc/include-head.php';?>
</head>
<body>
<!-- La topbar de nav -->
		<nav class="navbar navbar-default text-center navAuth" role="navigation">
			<div class="container">
				<a class="navbar-auth-inscription" href="#">WF3 Mini FaceBook</a>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<!-- fin topBar -->
	<!-- Contenu principal -->
	<main class="container suscribe-body">
	
	<!-- titre du formulaire qui donne l'impression d'etre le titre de la page -->
	<section class="text-center page-header container-full">
		<h1>Inscription</h1>
	</section>

		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div class="row" style="margin: 0;">
			<div class="form-group col-lg-12 col-md-12 text-center">
				<input type="text" class="form-control" name="UserLastName" id="UserLastName" placeholder="Nom">
				</div>
				<div class="form-group col-lg-12 col-md-12 text-center">
				<input type="text" class="form-control" name="UserFirstName" id="UserFirstName" placeholder="Prenom">
				</div>
				<div class="form-group col-lg-12 col-md-12 text-center">
				<input type="email" class="form-control" name="UserEmail" id="UserEmail" placeholder="Email">
				</div>
				<div class="form-group col-lg-12 col-md-12 text-center">
				<input type="password" class="form-control" name="UserPassword" id="UserEmail" placeholder="Mot de passe">
				</div>
				<div class="form-group col-lg-12 col-md-12 text-center">
				<input type="date" class="form-control" name="UserBirthday" id="datepicker" placeholder="Date de naissance">
				</div>
				<div class="form-group text-right col-lg-12 col-md-12">
					<span class="btn btn-primary btn-file btn-block">
						<input name="UserAvatar" id="UserAvatar" type="file">
					</span>				
				</div>
				<div class="form-group col-lg-12 col-md-12 text-center">
					<textarea class="form-control" name="UserDescription" id="UserDescription" cols="30" rows="10" placeholder="Parlez nous de vous"></textarea>
				</div>
				<div class="form-group col-lg-12 col-md-12 text-left">
					<label class="radio-inline"><input type="radio" name="UserGender">Homme</label>
					<label class="radio-inline"><input type="radio" name="UserGender">Femme</label>
				</div>
				<div class="form-group text-center">
					<input type="submit" class="btn btn-primary text-center">
				</div>
				
			</div>			
		</form>
	</main>

	<!-- inclusion du fichier qui contient tous les script des pages -->
	<?php include 'inc/include-script.php';?>
<script>
  	$( function() {
    $( "#datepicker" ).datepicker();
  } );
</script>
</body>
</html>