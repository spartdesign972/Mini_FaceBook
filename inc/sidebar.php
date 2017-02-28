<?php
// Variables pour effectuer des tests
$_SESSION['UserAvatar'] = 'avatar.png';
$_SESSION['lastname'] = 'TestNom';
$_SESSION['firstname'] = 'TestPrenom';

?>

<!-- debut -->
<div class="sidebar-left text-center">
    <h4>bonjour</h4>
    <img src="./assets/img/<?=$_SESSION['UserAvatar']; ?>" class="img-responsive img-circle" alt="Image Avatar">
    <h4><?=$_SESSION['lastname']; ?></h4>
    <h4><?=$_SESSION['firstname']; ?></h4>
    <div class="navside">
        <ul>
            <li><a href="publier.php">Publier</a></li>
            <li><a href="mesPublications.php">Mes Publications</a></li>
        </ul>
    </div>
</div><!-- fin sidebar -->