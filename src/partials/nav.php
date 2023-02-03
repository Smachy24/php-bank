  <header>
        <div id="back_header">

            <div id="logo">
                <img src="https://media.discordapp.net/attachments/301039123160891402/1069978978703646780/money-with-wings_1f4b8.png" alt="">
                <p><a href="/index.php?page=home">Bank Of Coding</a></p>
            </div>

            <div id="menu_fenetre">
                <form action="">

                    <?php 
                    if ($user)
                    {
                        if ($user['role'] == 1000) { ?>
                            <!-- page s'affichant si connecté et admin -->
                            <button><a class="menu_a" href="/index.php?page=dashboard_admin">Admin</a></button>

                        <?php }
                        if ($user['role'] >= 200) { ?>
                            <!-- page s'affichant si connecté et manager -->
                            <button><a class="menu_a" href="/index.php?page=dashboard_manager">Manager</a></button>
                        <?php }
                        if ($user['role'] == 10) { ?>
                            <!-- page s'affichant si connecté et vérifié mais pas manager ou admin-->
                            <button><a class="menu_a" href="/index.php?page=deposit">Deposer</a></button>
                            <button><a class="menu_a" href="/index.php?page=withdrawal">Retrait</a></button>
                            <button><a class="menu_a" href="/index.php?page=convertion">Convertion</a></button>
                            <button><a class="menu_a" href="/index.php?page=transfer">Virement</a></button>
                        <?php } ?> 
                            <!-- page s'affichant dans toute situation si connecté -->
                            <button><a class="menu_a" href="/index.php?page=account">Compte</a></button>
                            <button><a class="menu_a" href="/actions/logout.php">Logout</a></button><?php

                    }
                    else { ?>
                        <!-- page s'affichant si déconnecté -->
                        <button><a class="menu_a" href="/index.php?page=register">Inscription</a></button>
                        <button><a class="menu_a" href="/index.php?page=login">Connexion</a></button>
                    <?php } ?>
                    <!-- page s'affichant dans toute situation -->
                    <button><a class="menu_a" href="/index.php?page=home">Accueil</a></button>
                            
                </form>
            </div>

        </div>
    </header>
