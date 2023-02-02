<!-- recupération potentiel message d'erreur -->
<?php
$errors = get_errors();
?>

<div id="real_body">
            <!-- affichage d'un potentiel message d'erreur au dessus du form -->
            <?php 
                if ($errors !== false) {
                    echo '<p>'.$errors.'</p>';
            } ?>

            <div id="retrait_back03">

                <form id="retrait" action="/actions/login.php" method="post">

                    <p id="titre_retrait">👤 Connectez-vous</p>
                    
                    <p class="info_input">Email</p>
                    <input type="text" name="email" id="" placeholder="name@mail.com">
                    
                    <p class="info_input">Mot de passe</p>
                    <input type="password" name="password" id="" placeholder="Saisissez votre mot de passe">

                    <button type="submit">Se connecter</button>
                    <p class="info_input">Pas de compte ? Cliquer <a href="index.php?page=register">ici</a></p>

                    


                </form>
            </div>
        </div>