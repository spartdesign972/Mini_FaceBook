<?php
session_start();

require_once 'inc/connect.php';

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Plublication</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
    </head>
    <body>

        <nav class="navbar navbar-default" role="navigation">
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
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>

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
            <!-- En-Tête de Présentation -->
            <div class="pageTitle text-center">
                <h1>Publier</h1>
            </div>

            <!-- Début Formulaire -->

                <form id="contact" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Titre de la publication -->
                        <div class="form-group">
                            <div class="col-md-8">
                                <input id="title" name="title" type="text" placeholder="Titre de la publication" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="form-group">
                            <div class="col-md-8">
                                <input id="picture" name="picture" type="file" placeholder="Image à la une" accept="image/*" class="form-control input-md">
                            </div>
                        </div>
                        <br>
                        <p><strong>OU</strong></p>
                        <br>
                        <!-- Url Video -->
                        <div class="form-group">
                            <div class="col-md-8">
                                <input id="UrlVideo" name="UrlVideo" type="text" placeholder="Entrez l'Url d'une video" class="form-control input-md">
                            </div>
                        </div>
                        <!-- Publication -->
                        <div class="form-group">
                            <div class="col-md-8">
                                <textarea class="form-control" rows="15" id="comment" placeholder="Publier"></textarea>
                            </div>
                        </div>
                        <!-- Bouton d'Envoi -->
                        <div class="form-group">
                            <div class="<col-md-7></col-md-7> col-xs-offset-4">
                                <button type="submit" class="btn btn-primary" name="inscription" value="Ajouter le Contact">Publier</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- /.col-sm-6 -->
            <!-- Fin Formulaire -->
        </div>
        </main>
        <!-- inclusion du fichier qui contient tous les script des pages -->
        <?php include 'inc/include-script.php';?>
    </body>
</html>