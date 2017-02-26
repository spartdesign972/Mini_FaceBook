<?php

?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Auth-inscription</title>

		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

		<link href="https://fonts.googleapis.com/css?family=Oleo+Script|Roboto" rel="stylesheet"> 

		<link rel="stylesheet" type="text/css" href="./assets/css/style.css">

	</head>
	<body>
		<!-- La topbar de nav -->
		<nav class="navbar navbar-default text-center" role="navigation">
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
				<h2>Pas encore membre ? tu fou quoi ? inscrit toi vite !</h2>
				<a href="#" class="btn btn-default">S'inscrire</a>
			</div>


		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<!-- Latest compiled and minified JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>