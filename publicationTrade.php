<?php
session_start();
require_once 'inc/connect.php';

?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Publication Trade</title>
        <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
        <?php include 'inc/include-head.php';?>
    </head>
    <body>
        
        <!-- Menu -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- Gestion du Menu Burger : Version Mobile -->
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
                        <li><a href="modificationProfile.php">Mon Profile</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
        </nav>
        <!-- Fin du Menu -->
        
        <!-- Page -->
        <div class="container">
            <!-- Sidebar -->
            <?php require_once 'inc/sidebar.php'; ?>
            

            <!-- contenu -->
            <div class="content">
                <div class="col-sm-12">
                    <section id="partie1">
                        <p><i class="fa fa-user fa-3x" aria-hidden="true"> Publier par: {Nom, Prenom}</i></p>
                        <h3>Titre de la publication</h3>
                        <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
                        <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' vous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voire des phrases embarassantes).</p>
                        <div class="pouce"><i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>
                        </div>
                    </section>
                </div>
                <div class="col-sm-12">
                    <section id="partie2">
                        <p><i class="fa fa-user fa-3x" aria-hidden="true"> Publier par: {Nom, Prenom}</i></p>
                        <h3>Titre de la publication</h3>
                        <p>Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.</p>
                        <p>On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L'avantage du Lorem Ipsum sur un texte générique comme 'Du texte. Du texte. Du texte.' est qu'il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour 'Lorem Ipsum' vous conduira vers de nombreux sites qui n'en sont encore qu'à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d'y rajouter de petits clins d'oeil, voire des phrases embarassantes).</p>
                        <div class="pouce2">
                            <i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>
                        </div>
                    </section>
                </div>
                <!-- Fin contenu -->
            </div>
        </div>

        <!-- Fin de Page -->
        <!-- inclusion du fichier qui contient tous les script des pages -->
        <?php include 'inc/include-script.php';?>
    </body>
</html>