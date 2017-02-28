<?php
//session_start();
#integration et preparation de ma requete
//required_once'inc/connect.php';
//$sql =$bdd->prepare('INSERT INTO Users (UserFirstName, UserLastName, UserPassword, UserMail, UserAvatar, UserDescription, UserGender, UserBirthday) VALUES(:UserFirstName, :UserLastName, :UserPassword, :UserMail, :UserAvatar, :UserDescription, :UserGender, :UserBirthday)');


$post = []; //contiendra les données épurées du $_POST
$errors = []; //contiendra les erreurs relevées du $_POST

#définition de quelques variabl pour gerer les images
$maxSize = (1024 * 1000) * 2; // Taille maximum du fichier
$uploadDir = 'uploads/'; // Répertoire d'upload
$mimeTypeAvailable = ['image/jpg', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'];

#verification de l'existance de l'envoi des données puis vérificatio de celle ci
if(!empty($_POST))
{
	foreach ($_POST as $key => $value)
	{
		$post[$key] = (trim(strip_tags($value))); //netoyage des données, on enlève les balise HTML et autres ainsi que les espaces en début et fin de chaine
	}

	if(strlen($post['UserLastName'])<5 || strlen($post['UserLastName'])>50)
	{
		$errors[] = 'Votre nom doit faire entre  5 et 50 caratères';
	}

	if(strlen($post['UserFirstName'])<5 || strlen($post['UserFirstName'])>50)
	{
		$errors[] = 'Votre prénom doit faire entre  5 et 50 caratères';
	}

	if(strlen($post['UserDescription']) < 20){
		$errors[] = 'La description doit comporter au moins 20 caractères, soyez plus bavard :)';
	}

	if(strlen($post['userPassword'])<5)
	{
		$errors[] = 'Le mot de passe doit faire au minimum 5 caractères';
	}

	if(!filter_var($post['UserEmail'],FILTER_VALIDATE_EMAIL))
	{
		$errors[] = 'Il y a une erreur au niveau du mail...';
	}

	if(!isset($post['UserGender']) || !empty($post['UserGender']))
	{
		$errors[] = 'Précisersi vous êtes une femme ou homme...';
	}

	if(isset($_FILES['UserAvatar']) && $_FILES['UserAvatar']['error'] === 0){

		$finfo = new finfo(); //déclaration d'un objet de type finfo
		$mimeType = $finfo->file($_FILES['UserAvatar']['tmp_name'], FILEINFO_MIME_TYPE); // récuperation du type mime du fichier, cette façon de faire est la plus sécure

		$extension = pathinfo($_FILES['UserAvatar']['name'], PATHINFO_EXTENSION);//Récuperer l'extension du ficher grace au path info

		if(in_array($mimeType, $mimeTypeAvailable)){

			if($_FILES['UserAvatar']['size'] <= $maxSize){

				if(!is_dir($uploadDir)){
					mkdir($uploadDir, 0755);//création du dossier via le CHmod, permet d'avoir les droit d'ecriture
				}

				$newPictureName = uniqid('avatar_').'.'.$extension;//changeent du nom du fichier avec le prefixe avatar et lui donnant un id unique. Adie les remplacement

				if(!move_uploaded_file($_FILES['UserAvatar']['tmp_name'], $uploadDir.$newPictureName)){
					$errors[] = 'Erreur lors de l\'upload de la photo';
				}
			}

			else {
				$errors[] = 'La taille du fichier excède 2 Mo';
			}

		}

		else {
			$errors[] = 'Le fichier n\'est pas une image valide';
		}
	}

	else {
		$errors[] = 'Aucune photo sélectionnée';
	}


	#s'il n'y a pas d'erreur alors :
	if(count($errors) === 0)
	{
		$post['userPassword'] = password_hash($post['userPassword'], PASSWORD_DEFAULT);//hashage du mdp
		/*$sql->bindValue(':UserFirstName',$post['UserFirstName']);
		$sql->bindValue(':UserLastName',$post['UserLastName']);
		$sql->bindValue(':UserPassword',$post['UserPassword']);
		$sql->bindValue(':UserMail',$post['UserMail']);
		$sql->bindValue(':UserAvatar',$post['UserAvatar']);
		$sql->bindValue(':UserDescription',$post['UserDescription']);
		$sql->bindValue(':UserGender',$post['UserGender']);
		$sql->bindValue(':UserBirthday',$post['UserBirthday'],PDO::PARAM_DATE);

		if($sql->execute())
		{
			$success = 'Inscription reussie';
		}
		else
		{
			var_dump($sql->errorInfo());
		}*/
	}
	#s'il y a au moins une erreur:
	else 
	{
		$textErrors = implode('<br>', $errors);
	}

}

?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Inscription</title>
	<!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
	<?php include 'inc/include-head.php';?>
</head>
<body>
	<!-- Contenu principal -->
	<main class="container suscribe-body jumbotron">
	
	<!-- header -->
	<header>
		<p  class="text-center container clearfix suscribe-header"><strong>WF3 </strong>Mini Facebook</p>
	</header>

	<!-- titre du formulaire qui donne l'impression d'etre le titre de la page -->
	<section class="text-center page-header container-full">
		<h1>Inscription</h1>
	</section>

		<form method="POST" class="form-horizontal" enctype="multipart/form-data">
			<div class="row" style="margin: 0;">
			<?php if(isset($textErrors)){echo $textErrors;} ?>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="UserLastName">Nom</label>-->
					<input type="text" class="form-control" name="UserLastName" id="UserLastName" placeholder="Nom" required>
				</div>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="UserFirstName">Prénom :</label>-->
					<input type="text" class="form-control" name="UserFirstName" id="UserFirstName" placeholder="Prenom" required>
				</div>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="UserEmail" class="col-xs-1">Email :</label>-->
					<input type="email" class="form-control col-xs-11" name="UserEmail" id="UserEmail" placeholder="Email" required>
				</div>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="userPassword">Mot de passe :</label>-->
					<input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Votre mot de passe" required>
				</div>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="datepicker">Date de naissance :</label>-->
					<input type="date" class="form-control" name="UserBirthday" id="datepicker" placeholder="Date de naissance" required>
				</div>

				<div class="form-group text-right col-lg-12 col-md-12 has-feedback">
					<!--<label for="UserAvatar">Image de profil :</label>-->
					<div class="fileinput fileinput-new" data-provides="fileinput"> 
					<!-- Souce du code https://jsfiddle.net/jasny/vtGxm/ -->
    					<span class="btn btn-default btn-file btn-block">
    						<span>Sélectionnez une image de profil</span>
    						<input type="file" name="UserAvatar" id="UserAvatar" type="file" accept="image/*" required/>
    					</span>
    				</div>	
				</div>

				<div class="form-group col-lg-12 col-md-12 text-center has-feedback">
					<!--<label for="UserDescription"></label>-->
					<textarea class="form-control" name="UserDescription" id="UserDescription" cols="30" rows="10" placeholder="Parlez nous de vous" required></textarea>
				</div>

				<div class="form-group col-lg-12 col-md-12 text-left has-feedback">
					<!--<label for="UserGender">Genre :</label>-->
					<label class="radio-inline"><input type="radio" name="UserGender" value="Homme" required>Homme</label>
					<label class="radio-inline"><input type="radio" name="UserGender" value="Femme" required>Femme</label>
				</div>

				<div class="form-group text-center">
					<input type="submit" class="btn btn-primary text-center">
				</div>
				
			</div>	<!-- Fin de la row -->		
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