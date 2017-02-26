<?php 
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Plublication</title>

        <!-- Pour Internet Explorer : S'assurer qu'il utilise la dernière version du moteur de rendu -->
        <meta http-equiv="X-UA-Compatible" content="IE-edge">

        <!-- Affichage sans zoom pour les mobiles -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Styles CSS -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shiv -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js" integrity="sha256-sqQlcOZwgKkBRRn5WvShSsuopOdq9c3U+StqgPiFhHQ=" crossorigin="anonymous"></script>

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


        <main class="container">

            <section class="row">
                <!-- En-Tête de Présentation -->
                <div class="contact col-xs-12">
                    <h1>Publier</h1>
                </div>




            </section>

            <section class="row">

                <!-- Début Formulaire -->
                <div class="col-sm-12">
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
                            <p>OU</p>
                            <br>

                            <!-- Url Video -->
                            <div class="form-group">

                                <div class="col-md-8">
                                    <input id="UrlVideo" name="UrlVideo" type="text" placeholder="Entrez l'Url d'une video" class="form-control input-md">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8">

                                    <textarea class="form-control" rows="5" id="comment" placeholder="Publier"></textarea>
                                </div>
                            </div>


                            <!-- Bouton d'Envoi -->
                            <div class="form-group">
                                <div class="<col-xs-7></col-xs-7> col-xs-offset-3">
                                    <button type="submit" class="btn btn-primary" name="inscription" value="Ajouter le Contact">Ajouter le Contact</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <!-- /.col-sm-6 -->
                <!-- Fin Formulaire -->

            </section>
        </main>







        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>

    </html>