<?php
session_start();

require_once 'inc/connect.php';

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
				<ul class="nav navbar-nav navbar-left">
                    <li><a href="publicationTrade.php">Les Postes</a></li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="modificationProfile.php">Mon Profile</a></li>
					<li><a href="confirmLogout.php">Logout</a></li>
				</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<!-- fin topBar -->
		<div class="container">
      
			<!-- Sidebar -->
			<?php require_once 'inc/sidebar.php'; ?>

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


		<!-- inclusion du fichier qui contient tous les script des pages -->
		<?php include 'inc/include-script.php';?>
	</body>
</html>