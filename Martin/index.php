<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8"/>
        <title>
            Storystoire - Accueil
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    </head>

    <body>
        <div id="content">
            <header><h1>Bienvenue sur Storystoire</h1></header>
            <nav>
                <ul class="menu">
                    <!-- <li class="menuitem"><a href="connexion3.php">Se connecter</a></li> -->
                    <li class="menuitem"><a href="#classement">Rechercher</a></li>
                    <li class="menuitem"><a href="#contact">Contacts</a></li>
                    <li class="menuitem"><!-- Button to open the modal login form -->
                        <button onclick="if (document.getElementById('id01').style.display=='block') {document.getElementById('id01').style.display='none';} 
                        else {document.getElementById('id01').style.display='block';}">Se connecter</button>
                    </li>
                    <li>
                        <div id="id01" class="modal">
                            <!-- <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span> -->

                            <!-- Modal Content -->
                            <form class="modal-content animate" action="/index.php" style="">

                                <div class="container">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname" required>

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw" required>

                                <button type="submit">Login</button>
                                <!-- <label>
                                    <input type="checkbox" checked="checked" name="remember"> Remember me
                                </label> -->
                                </div>

                                <!-- <div class="container" style="background-color:#f1f1f1">
                                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                                <span class="psw">Forgot <a href="#">password?</a></span>
                                </div> -->
                            </form>
                        </div>
                        <script type="text/javascript">document.getElementById('id01').style.display='none'</script>
                    </li>
                </ul>            
            </nav>

            <div id="coteacote">
                <section>
                    <article>
                        <h2 id="intro">Présentation</h2>
                            <p class="loremipsum">Bonjour et bienvenue sur Storystoire, l'histoire dont VOUS êtes le héros !</p>
                            <p class="loremipsum">Storystoire est un projet de CSWD (Conception de Sites Web Dynamiques) proposé en L2 de License MIASHS. Il a pour but de vous laisser créer des histoires à choix que vous pourrez ensuite publier sur ce site. Une fois votre histoire construite, vous pouvez décider de la publier et elle deviendra alors accesible à n'importe qui d'intéressé par votre travail. Ces personnes pourront consulter votre histoire à choix et la vivre ! (Je suis pas bon pour réduger les description wesh)</p>
                        </article>

                    <article>
                        <h2 id="classement">En ce moment</h2>
                        <div class="classement">
                            <h3>Top10 des histoires les plus vues</h3>
                            <ol>
                                <!-- FAIRE LA REQUETE PHP MYSQL DES HISTOIRES LES PLUS LIKE ET EN FAIRE UNE LISTE ORDONEE -->
                            </ol>
                        </div>
                        <!-- <div class="classement">
                            <h3>Top10 des classements des joueurs de tennis féminins</h3>
                            <ol>
                                <li>WOZNIACKI Caroline</li>
                                <li>HALEP Simona</li>
                                <li>SVITOLINA Elina</li>
                                <li>MUGURUZA Garbine</li>
                                <li>PLISKOVA Karolina</li>
                                <li>OSTAPENKO Jelena</li>
                                <li>GARCIA Caroline</li>
                                <li id="prefere">WILLIAMS Venus</li>
                                <li>KERBER Angelique</li>
                                <li>MLADENOVIC Kristina</li>
                            </ol>
                        </div> -->
                    </article>

                    <article>
                        <h2 id="contact">Contacts</h2>
                    </article>
                </section>
            
                <aside>
                    <h2>Sujets liés</h2>
                        <a href="https://www.lequipe.fr/Tennis/atp-classement.html">Classement joueurs masculins - L'Equipe.fr</a>
                        <br/><a href="https://www.lequipe.fr/Tennis/wta-classement.html">Classement joueurs féminins - L'Equipe.fr</a>
                </aside>
            </div>
            <footer>Ce site a été créé par Maxime Dulieudit, Fannie Notaire et Martin Defraises</footer>
        </div>
    </body>
</html>