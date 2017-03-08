<?php
session_start();
require_once 'inc/connect.php';


function Redirect($e)
{
	switch ($e) 
	{
		case 1:
			echo '<p class="alert alert-danger"> Erreur, vous avez déjà like le post</p>';
			echo '<a href="publicationTrade.php">Retour aux publications</a>'
			break;
		case 2:
			echo '<p class="alert alert-success"> Post like :B </p>';
			echo '<a href="publicationTrade.php">Retour aux publications</a>'
			break;
		case 3:
			echo '<p class="alert alert-warning"> Erreur, Aucun post sélectionné </p>';
			echo '<a href="publicationTrade.php">Retour aux publications</a>'
			break;
		case 4:
			echo '<p class="alert alert-danger"> Erreur, utilisateur non reconu </p>';
			echo '<a href="auth_inscription.php">Retour aux publications</a>'
			break;
	}
}

if(!isset($_GET['id']) || empty($_GET['id']))
{
	$error = 3;
}

if(empty($_SESSION['idUser']))
{
	$error = 4;
}



if(!empty($_GET['id']) || !empty($_SESSION['idUser']))
{
	$idStatut = (int)$_GET['id'];

	$like=$bdd->prepare('SELECT idLikeStatus FROM likestatus AS L INNER JOIN statut AS S ON S.Statut_idStatut = L.idStatut WHERE S.Statut_idStatut = :idStatut AND S.Users_idUsers= :idUser');
	$like->bindValue(':idStatut', $idStatut, PDO::PARAM_INT);
	$like->bindValue(':idUser', $_SESSION['idUser'], PDO::PARAM_INT);

	if($like->execute())
	{
		$res = $like->fetch(PDO::FETCH_ASSOC);
		if(!empty($res)) //si la requette ne retourne pas de résultat
		{
			$error = 1;
		}
	}
	else
	{
		var_dump($like->errorInfo());
	}
}

#si dans mon url j'ai une action qui s'appelle confirm et qu'elle existe + s'il y a un id dans l'url et qu'il n'est pas vide
if((isset($_GET['action'])) && ($_GET['action'] == 'confirm') && isset($_GET['id']) && !empty($_GET['id'])) 
{
	$newLike = $bdd->prepare('INSERT INTO likestatus SET(Statut_idStatut,Users_idUsers) VALUES(:idStatut, :idUser)');
	$newLike->bindValue(':idSatut', $idSatut, PDO::PARAM_INT);
	$newLike->bindValue(':idUser', $_SESSION['idUser'], PDO::PARAM_INT);
	if($newLike->execute)
	{
		$error = 2;
	}
	else
	{
		var_dump($newLike->errorInfo());
	}
}

?>
<!DOCTYPE html>
<html lang="fr">
	<head>
	<meta charset="UTF-8">
	<title>Like confirm</title>
	<!-- Contient toutes les dépense du head lié a ma page-->
	<?php include 'inc/include-head.php';?>
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
						<?php 
						if(isset($error))
						{
							Redirect($error);
						}
						if(!isset($error)):
						?>
						<h1>Voulez vous confirmer le like??</h1>
						<p>
						<a class="btn btn-primary btn-lg" href="confirmLike2.php?action=confirm&amp;id=<?php echo $idStatut;?>">Like !!!!!!!!!!!</a>
						</p>
					<?php endif?>
					</div>
				</div>
			</div>
		</div>
	<!-- Contient tous les script lié a ma page -->
	<?php include 'inc/include-script.php';?>
</body>
</html>

<!-- pour ouvrir une modale sur le like
	<a href="confirmLike.php?id=<?php //echo $value['idStatut'];?>" onclick="window.open(this.href, '', 'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=600, height=350'); return false;">
		<button class="btn btn-info">Ajouter au panier</button>
	</a>
-->