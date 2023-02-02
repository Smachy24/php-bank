    <?php
    $errors = get_errors();
    if ($errors !== false) {
        echo '<p>'.$errors.'</p>';
    } ?>

    <div id="real_body">
                <div id="retrait_back04">
                    <form id="retrait" action="">

                        <p id="hello">👋 Bonjour <span>Mathis</span></p>
                        <p id="titre_retrait02">Vous êtes un : Utilisateur</p>

                        
                        <div id="mes_infos">
                            <div class="titre_infos">
                                <p>📁 <span class="span_titre_infos">Mes informations :</span></p>
                            </div>

                            <div class="infos_user">
                                <p>RIB : <span id="rib">FR0298 73898 8779 8797 3232 67 84</span></p>
                                <p>IBAN : <span id="iban">FR0298 73898 8779 8797 3232 67 84</span></p>
                            </div>
                        </div>

                        <div id="mon_activite">

                        </div>

                            <button class="logout" type="submit"><a class="logout_a" href="/actions/logout.php">Se deconnecter</a></button>


                    </form>
                </div>
            </div>
