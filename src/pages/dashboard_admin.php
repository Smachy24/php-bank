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



                            <table class="tableau-style">

                            <thead class="hight_table0202">
                                <tr class="name_column">
                                    <th>NOM COMPLET</th>
                                    <th>EMAIL</th>
                                    <th>DATE DE CREATION</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <?php

                            $sql='SELECT fullname,email,created_at FROM user ORDER by fullname';

                            $result = $dbManager->select($sql,[]);


                            foreach ($result as $row) {
                            echo '<tr class="tableau_bas02">
                                    <th> ' . $row["fullname"] . '  </th>
                                    <th> ' . $row["email"] . ' </th>
                                    <th> ' . $row["created_at"] . ' </th>
                                </tr>';
                         }
                                ?>
                        </form>
                            </tbody>

                            </table>

                        </div>



                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">💳 <span class="span_titre_infos">Les dernières transactions :</span></p>

                            <table class="tableau-style">

                            <thead class="hight_table0202">
                                <tr class="name_column">
                                    <th>DESTINATAIRE</th>
                                    <th>EXPÉDITEUR</th>
                                    <th>DEVISE</th>
                                    <th>MONTANT</th>
                                    <th>DATE & HEURE</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <?php

                            $sql='SELECT receiver.fullname AS name_receiver, 
                            sender.fullname AS name_sender, 
                            currency.name AS name_currency, 
                            transaction.amount,
                            transaction.date
                            FROM transaction 
                            
                            JOIN user receiver
                            ON Transaction.id_receiver = receiver.user_id
                            
                            JOIN user sender
                            ON Transaction.id_sender = sender.user_id
                            
                            JOIN currency 
                            ON TRANSACTION.id_currency = currency.currency_id
                            
                            ORDER BY date DESC LIMIT 10';

                            $result = $dbManager->select($sql,[]);


                            foreach ($result as $row) {
                            echo '<tr class="tableau_bas02">
                                    <th> ' . $row["name_receiver"] . '  </th>
                                    <th> ' . $row["name_sender"] . ' </th>
                                    <th> ' . $row["name_currency"] . ' </th>
                                    <th> ' . $row["amount"] . ' </th>
                                    <th> ' . $row["date"] . ' </th>
                                </tr>';
                         }
                                ?>
                        </form>
                            </tbody>

                            </table>


                        </div>



                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">🔼 <span class="span_titre_infos">Liste des depôts des utilisateurs :</span></p>
                        

                            <table class="tableau-style">

                            <thead class="hight_table02">
                                <tr class="name_column">
                                    <th>ID TRANSACTION</th>
                                    <th>UTILISATEUR</th>
                                    <th>MANAGER</th>
                                    <th>DEVISE</th>
                                    <th>MONTANT</th>
                                    <th>DATE & HEURE</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <?php

                            $sql='SELECT transaction_id, sender.fullname AS name_sender, 
                            manager.fullname AS name_manager,  currency.name, amount, date FROM transaction
                            JOIN user manager
                            ON transaction.id_manager=manager.user_id
                            join user sender
                            ON transaction.id_sender=sender.user_id
                            JOIN currency
                            ON transaction.id_currency=currency.currency_id
                            WHERE type = "DEPO"
                            ORDER BY date';

                            $result = $dbManager->select($sql,[]);


                            foreach ($result as $row) {
                            echo '<tr class="tableau_bas02">
                                    <th> ' . $row["transaction_id"] . '  </th>
                                    <th> ' . $row["name_sender"] . ' </th>
                                    <th> ' . $row["name_manager"] . ' </th>
                                    <th> ' . $row["name"] . ' </th>
                                    <th> ' . $row["amount"] . ' </th>
                                    <th> ' . $row["date"] . ' </th>
                                </tr>';
                         }
                                ?>
                        </form>
                            </tbody>

                            </table>


                        </div>

                    
                        <div id="mon_activite02">

                            <p style="margin-left:2%; margin-top:1%">🔽 <span class="span_titre_infos">Liste des retraits des utilisateurs :</span></p>
                            
                        <table class="tableau-style">

                            <thead class="hight_table0202">
                                <tr class="name_column">
                                    <th>ID TRANSACTION</th>
                                    <th>UTILISATEUR</th>
                                    <th>MANAGER</th>
                                    <th>DEVISE</th>
                                    <th>MONTANT</th>
                                    <th>DATE & HEURE</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            <?php

                            $sql='SELECT transaction_id, sender.fullname AS name_sender, 
                            manager.fullname AS name_manager,  currency.name, amount, date FROM transaction
                            JOIN user manager
                            ON transaction.id_manager=manager.user_id
                            join user sender
                            ON transaction.id_sender=sender.user_id
                            JOIN currency
                            ON transaction.id_currency=currency.currency_id
                            WHERE type = "RETRAIT"
                            ORDER BY date';

                            $result = $dbManager->select($sql,[]);


                            foreach ($result as $row) {
                            echo '<tr class="tableau_bas02">
                                    <th> ' . $row["transaction_id"] . '  </th>
                                    <th> ' . $row["name_sender"] . ' </th>
                                    <th> ' . $row["name_manager"] . ' </th>
                                    <th> ' . $row["name"] . ' </th>
                                    <th> ' . $row["amount"] . ' </th>
                                    <th> ' . $row["date"] . ' </th>
                                </tr>';
                         }
                                ?>
                        </form>
                            </tbody>

                            </table>
                        </div>



            </div>
    </div>
