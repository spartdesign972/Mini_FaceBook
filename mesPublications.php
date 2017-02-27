<?php
session_start();

require_once 'inc/connect.php';

//pour tester

$select = $bdd->prepare('SELECT * FROM users WHERE idUser=2');
	$select->execute();
	$user = $select->Fetch(PDO::FETCH_ASSOC);
				$_SESSION['lastname']    = $user['UserLastName'];			
				$_SESSION['firstname']   = $user['UserFirstName'];
				$_SESSION['idUser']      = $user['idUser'];
				$_SESSION['UserAvatar']  = $user['UserAvatar'];
				
//Fin élément de test
	$statut = $bdd->prepare('SELECT StatutTitle FROM statut WHERE 	Users_idUsers=:idUser');
	$statut->bindValue(':idUser',$_SESSION['idUser'],PDO::PARAM_INT);
	$statut->execute();
	$statut_list = $statut->FetchAll(PDO::FETCH_ASSOC);

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
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<!-- fin topBar -->
		<div class="container">
			<div class="sidebar-left text-center">
			<h4>bonjour</h4>
			<img src="./assets/img/<?=$_SESSION['UserAvatar']; ?>" class="img-responsive img-circle" alt="Image Avatar">
			<h4><?=$_SESSION['lastname']; ?></h4>
			<h4><?=$_SESSION['firstname']; ?></h4>
			<div class="navside">
				<ul>
					<li><a href="publier.php">Publier</a></li>
					<li><a href="#">Mes Publications</a></li>
				</ul>
			</div>

		</div>
		<div class="content">
			<div class="pageTitle text-center">
				<h1>Mes Publications</h1>
			</div>
			<hr>
			<div class="publications">
			
			<?php foreach($statut_list as $value):?>
			
				<div class="publica">
					<h3>
						<?= $value['StatutTitle']; ?>
						<a href="publier.php"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="effacer.php"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</h3>
				</div>
				
			<?php endforeach; ?>
				
			</div>
		</div>
		</div>


		<!-- inclusion du fichier qui contient tous les script des pages -->
		<?php include 'inc/include-script.php';?>
	</body>
</html>