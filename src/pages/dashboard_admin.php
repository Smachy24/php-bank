<?php
    require_once __DIR__ .'/../init.php';
    $errors = get_errors();
    if ($errors !== false) {
        echo '<p>'.$errors.'</p>';
    } ?>

    <div id="real_body">

                <div id="retrait_back06">
                    <form id="retrait" action="">

                        <p id="hello">🤖 Panneau Administrateur</p>
                        <p id="titre_retrait02">Connecté en tant que : Utilisateur</p>

                        

                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">👥 <span class="span_titre_infos">Liste des utilisateurs :</span></p>


                            
                            <table class="table">

                                <thead class="thead">
                                    <tr>
                                        <th>Nom Complet</th>
                                        <th>Adresse mail</th>
                                        <th>Date de création</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    <tr>
                                        <td>Content 1</td>
                                        <td>Content 2</td>
                                        <td>Content 3</td>
                                    </tr>
                                    
                                </tbody>

                            </table>

                        </div>



                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">💳 <span class="span_titre_infos">Les dernières transactions :</span></p>

                        </div>



                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">🔼 <span class="span_titre_infos">Liste des depôts des utilisateurs :</span></p>
                        
                        </div>

                    
                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">🔽 <span class="span_titre_infos">Liste des retraits des utilisateurs :</span></p>
                        
                        </div>



            </div>
    </div>
