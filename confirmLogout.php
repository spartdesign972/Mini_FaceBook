<?php
session_start();

require_once 'inc/connect.php';

// Destruction de la session ?
	if ((isset($_GET['action'])) && ($_GET['action'] == 'logout'))
	{
		$_SESSION = array();
		session_destroy();
		session_start();
		sleep(1);
		header('location: auth_inscription.php');
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
                    <li><a href="publicationTrade.php">Les Posts</a></li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="modificationProfile.php">Mon Profil</a></li>
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
				<div class="jumbotron text-center">
					<div class="container">
						<h1>WTF ? <br>ta un truc a faire ? tu veux partir ?</h1>
						<p><br>Maiiiissss kesss tu nous faiiiiit RESSSSTTTT :(</p>
						<p>
						<img src="assets/img/minion_png.png" alt="minion" height="100px"><a class="btn btn-primary btn-lg" href="confirmLogout.php?action=logout">MiliKassos !</a>
						</p>
					</div>
				</div>
			</div>
		</div>


		<!-- inclusion du fichier qui contient tous les script des pages -->
		<?php include 'inc/include-script.php';?>
	</body>
</html>