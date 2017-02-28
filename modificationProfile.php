<?php

?><!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modification Profile</title>

    
    <!-- inclusion du fichier qui contient toutes besoin commune au page, comme le css, etc -->
    <?php include 'inc/include-head.php';?>

    <link rel="stylesheet" type="text/css" href="assets/css/modification.css">
    
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
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="publicationTrade.php">Les Postes</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li><a href="#">Mon Profile</a></li> -->
                    <li><a href="#">Logout</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>
    <!-- Fin du Menu -->


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <section id="modification">

                    <!-- Choix image -->
                    <div class="image">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="form-group">
                                    <label for="exampleInputFile">Image de profil</label>
                                    <input type="file" id="exampleInputFile">
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Début Formulaire -->
                    <form id="modification" class="form-horizontal" action="#" method="post" role="form" data-toggle="validator">

                        <!-- Nom -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="nom" name="nom" required class="form-control" data-error="N'oubliez pas de saisir votre nom" type="text" placeholder="Saisissez votre Nom">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Prénom -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="prenom" name="prenom" required class="form-control" data-error="N'oubliez pas de saisir votre prenom" type="text" placeholder="Saisissez votre Prénom">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <input id="email" name="email" required class="form-control" data-error="N'oubliez pas de saisir votre email" type="email" placeholder="Saisissez votre Email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Date de Naissance -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <input id="date de naissance" name="date de naisssance" required class="form-control" data-error="N'oubliez pas de saisir votre email" type="text" placeholder="Date de naissance">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group has-feedback">
                            <div class="col-xs-12">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                <textarea id="description" name="description" rows="5" placeholder="Description" class="form-control"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <!-- Bouton d'Envoi -->
                        <div class="col-xs-12">
                            <div class="form-group has-feedback">
                                <button type="submit" class="btn btn-primary" name="contact" value="Envoyer ma Demande">Modifier</button>
                            </div>
                        </div>

                    </form>
                </section>
            </div>
        </div>
    </div>


   <!-- inclusion du fichier qui contient tous les script des pages -->
    <?php include 'inc/include-script.php';?>

    <script>
        // -- Initialisation de jQuery
        $(function () {

            $('#modification').validator().on('submit', function (e) {

                if (!e.isDefaultPrevented()) {
                    $(this).replaceWith('<div class="alert alert-success">Votre Modification à bien été effectuer.</div>');
                }

                return false;

            });

        });
    </script>

</body>

</html>