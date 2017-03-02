<!-- debut -->
<div class="sidebar-left text-center">
    <div class="infos">
        <h4>bonjour</h4>
        <img src="./uploads/<?php echo $_SESSION['UserAvatar']; ?>" class="img-responsive img-circle" alt="Image Avatar">
        <h4><?php echo $_SESSION['lastname']; ?></h4>
        <h4><?php echo $_SESSION['firstname']; ?></h4>
    </div>
    <div class="navside">
        <ul>
            <li><a href="publier.php">Publier</a></li>
            <li><a href="mesPublications.php">Mes Publications</a></li>
        </ul>
    </div>
</div><!-- fin sidebar -->