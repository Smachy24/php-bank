<?php 
    //require_once __DIR__ . '/utils/gen_manager_table.php';
    // require_once __DIR__ . '/../src/utils/gen_manager_table.php';
    //if (!(user['role'] > 1000))
    if (!$user) {
        header('Location: /index.php?page=login');
        die();
    }
    elseif($user['role'] < 200)
    {
        header('Location: /index.php?page=login');
        die();
    }

    $errors = get_errors();
?>

    <?php
    require_once __DIR__ .'/../init.php';
    $errors = get_errors();
    if ($errors !== false) {
        echo '<p>'.$errors.'</p>';
    } ?>

    <div id="real_body">

                <div id="retrait_back06">
                    <form id="retrait" action="">

                        <p id="hello">👨🏻‍⚖️ Panneau Manager</p>
                        <p id="titre_retrait02">Connecté en tant que : <span style="color:white; text-decoration=none"><?php echo $user['fullname']; ?></span></p>

                        <div id="mon_activite03">

                            <p style="margin-left:2%; margin-top:1%">🔼 <span class="span_titre_infos">Les demandes de dépôt :</span></p>
                            <?php gen_table_structure("deposit") ?>

                        </div>

                        <div id="mon_activite03">

                            <p style="margin-left:2%; margin-top:1%">🔽 <span class="span_titre_infos">Les demandes de retrait :</span></p>
                            <?php gen_table_structure("withdrawal") ?>

                        </div>

                        <div id="mon_activite03">

                            <p style="margin-left:2%; margin-top:1%">✅ ⛔️ <span class="span_titre_infos">Vérifier ou bannir les utilisateurs :</span></p>
                            <table class="tableau-style">
                                <thead class="tableau-style">
                                    <tr class="name_column">
                                        <th>Utilisateur</th>
                                        <th>role</th>
                                        <th>email</th>
                                        <th>date création</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php gen_role_table() ?>
                                </tbody>
                            </table>

                        </div>

            </div>
    </div>
    
    
    
    
    
    
 