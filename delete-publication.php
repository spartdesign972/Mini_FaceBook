<?php
	
	require_once 'inc/connect.php';
	
	$delete = $bdd->prepare('DELETE * FROM statut WHERE idStatut=:idStatut');
	$delete->bindValue(':idStatut',$_GET['id']);
	$delete->execute();
	
	header('location:mesPublications.php');
	
?>