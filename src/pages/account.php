    <?php
    require_once __DIR__ .'/../init.php';
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
                            <table class="tableau-style">

                            <thead>
                                <tr>
                                    <th>name_receiver</th>
                                    <th>name_sender</th>
                                    <th>name_currency</th>
                                    <th>amount</th>
                                    <th>datetime</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            $sql='  SELECT receiver.fullname AS name_receiver, 
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
                            echo '<tr>
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

                            <button class="logout" type="submit"><a class="logout_a" href="/actions/logout.php">Se deconnecter</a></button>


                    </form>
                </div>
            </div>
