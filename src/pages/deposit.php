<?php 
require_once __DIR__ . '/../init.php';
$errors = get_errors();
 ?>


        <div id="real_body">
        <?php
            if ($errors !== false) {
                echo '<p>'.$errors.'</p>';
            } ?>
            <div id="retrait_back">
                <div class="soldes_all">

                    <?php
                        
                        $sql=  "SELECT * FROM account WHERE id_user = ?";
                        $options = [$_SESSION['user_id']];
                        $res = $dbManager->select($sql, $options);
                    ?>

                    <div class="euros_solde">
                        <img src="https://media.discordapp.net/attachments/301039123160891402/1070653442550415360/euro-banknote_1f4b6.png" alt="">
                        <p><?php echo $res[0]["amount"]; ?><span> €</span>
                        </p>
                    </div>

                    <div class="barre_droite"></div>

                    <div class="dollar_solde">
                        <img src="https://media.discordapp.net/attachments/301039123160891402/1070653442227445760/banknote-with-dollar-sign-2480.png" alt="">
                        <p><?php echo $res[1]["amount"]; ?><span> $</span>
                        </p>
                    </div>

                    <div class="barre_droite"></div>
                    
                    <div class="bitcoin_solde">
                        <img src="https://media.discordapp.net/attachments/301039123160891402/1070653917249163285/Nouveau_projet1.png" alt="">
                        <p><?php echo $res[2]["amount"]; ?><span> ฿</span>
                        </p>
                    </div>

                    
                    
                </div>
                <form id="retrait" action="actions/deposit.php" method="post">

                    <p id="titre_retrait">🔼 Effectuer un dépôt d'argent :</p>
                    
                    <p class="info_input">Devise du dépôt</p>
                    <input type="text" name="currency" id="" placeholder="EUROS - DOLLAR - BITCOIN">
                    
                    <p class="info_input">Montant du dépôt</p>
                    <input type="text" name="amount" id="" placeholder="20">

                    <button type="submit">Valider</button>


                </form>
            </div>
        </div>

</body>
</html>