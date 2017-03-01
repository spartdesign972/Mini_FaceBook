<?php
session_start();
require_once 'inc/connect.php';

$display = true;

function Redirect($e)
{
	switch ($e) 
	{
		case 1:
			echo '<p class="alert alert-danger"> Erreur, vous avez déjà like le post</p>';
			sleep(3);
			header("Location : publicationTrade.php");
			break;
		case 2:
			echo '<p class="alert alert-success"> Post like :B </p>';
			sleep(3);
			header("Location : publicationTrade.php");
			break;
		case 3:
			echo '<p class="alert alert-warning"> Erreur, Aucun post sélectionné </p>';
			sleep(3);
			header("Location : publicationTrade.php");
			break;
		case 4:
			echo '<p class="alert alert-danger"> Erreur, utilisateur non reconu </p>';
			sleep(3);
			header("Location : auth_inscription.php");
			break;
	}
}

if(!isset($_GET['id']) || empty($_GET['id']))
{
	$display = false;
	Redirect(3);
}

if(empty($_SESSION['idUser']))
{
	$display = false;
	Redirect(4);
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
		if($res[''])
		{
			
			if((isset($_GET['action'])) && ($_GET['action'] == 'confirm'))
			{
				$newLike = $bdd->prepare('INSERT INTO likestatus SET(Statut_idStatut,Users_idUsers) VALUES(:idStatut, :idUser)');
				$newLike->bindValue(':idSatut', $idSatut, PDO::PARAM_INT);
				$newLike->bindValue(':idUser', $_SESSION['idUser'], PDO::PARAM_INT);
				if($newLike->execute)
				{
					$present = 2;
				}
				else
				{
					var_dump($newLike->errorInfo());
				}
			}
			
		}
		else
		{
			$present = 1;
		}
	}
	else
	{
		var_dump($like->errorInfo());
	}
}
?>
<!DOCTYPE html>
<html lang="en">
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
						if(isset($present)){Redirect($present);}
						if($display):
						?>
						<h1>Voulez vous confirmer le like??</h1>
						<p>
						<a class="btn btn-primary btn-lg" href="confirmLike.php?action=confirm+id=<?php echo $idStatut;?>">Like !!!!!!!!!!!</a>
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