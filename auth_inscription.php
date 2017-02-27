<?php
session_start();

require_once 'inc/connect.php';

$post          = [];
$errors        = [];
$passwordMatch = true;
$emailNotExist = '';



if(!empty($_POST)){

	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	}
	if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$errors[] = 'format de mail invalide';
	}
	if(empty($post['password'])){
		$errors[] = 'Veuillez entrer votre MDP';
	}


	if(count($errors) === 0 ){
		// ===== insertion des infos dans la base de donnée
		$res = $bdd->prepare('SELECT UserLastName, UserFirstName, UserEmail, UserPassword, UserAvatar, idUser  FROM users WHERE UserEmail = :dataEmail');
		
		$res->bindValue(':dataEmail', $post['email'], PDO::PARAM_STR);
		
		if($res->execute()){
			$success = 'Bonjour';
			$user = $res->fetch(PDO::FETCH_ASSOC);
			if(password_verify($post['password'], $user['UserPassword'])){

				$_SESSION['isConnected'] = true;
				$_SESSION['lastname']    = $user['UserLastName'];
				$_SESSION['firstname']   = $user['UserFirstName'];
				$_SESSION['idUser']      = $user['idUser'];
				$_SESSION['UserAvatar']  = $user['UserAvatar'];

				
				// header('location: exo_recette.php');
			}else{
				$passwordMatch = false;
			}

		}else{
			
			$emailNotExist = false;
			//Erreur de dev
			var_dump($res->errorInfo());
			//die; // alias de exit(); => die('hello world')
		}
	}
	else {
		$affichError = true;
		$errorsText = implode('<br>', $errors);	
	}
}
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Auth-inscription</title>

		<!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
		<?php include 'inc/include-head.php';?>

		<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Roboto" rel="stylesheet"> 

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
			<div class="text-center top">
				<div class="container">
					<h1 class="title">Le Meilleur des reseaux sociaux</h1>
				</div>
			</div>

			<?php if(!empty($errors)): ?>
			<div class="container">
				<div class="alert alert-danger authAlert">
				  <h3><?php echo $errorsText ?></h3>
				</div>
			</div>
			<?php endif; ?>

			<?php 
			if(!$passwordMatch){
				echo '<div class="container">';
				echo '<div class="alert alert-danger authAlert">';
				echo '<h3>bonjour '.$user['UserFirstName'].'<br>';
				echo 'Les mots de passes ne correspondent pas</h3><br>';
				echo '<a href="auth_inscription.php" class="btn btn-default">Réessayer</a>';
				echo '</div>';
				echo '</div>';
			}	
			?>

			<div class="container formAuth">	
				<form action="" method="POST" class="form-horizontal text-center" role="form">
						<h2>Déja membre ? merci de vous authentifier</h2>
						<div class="form-group col-xs-12">
							<input type="email" name="email" id="inputEmail" class="form-control" value="" required="required" placeholder="Email">
						</div>

						<div class="form-group col-xs-12">
							<input type="password" name="password" id="inputPassword" class="form-control" value="" required="required" placeholder="Mot de passe">
						</div>
				
						<div class="form-group">
							<div class="col-xs-12 text-center">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
				</form>
			</div>

			<div class="container text-center inscrip">
				<h2>Pas encore membre ? t'es fou ou quoi ? inscrit toi vite !</h2>
				<a href="suscribe.php" class="btn btn-default">S'inscrire</a>
			</div>


		<!-- inclusion du fichier qui contient tous les script des pages -->
	<?php include 'inc/include-script.php';?>
	</body>
</html>