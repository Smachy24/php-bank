<?php 
require_once __DIR__ . '/../init.php';
$errors = get_errors();
 ?>
<body>

    
    

	<div id="real_body">
            <?php
            if ($errors !== false) {
                echo '<p>'.$errors.'</p>';
            } ?>
            <div id="retrait_back05">

                <div class="soldes_all">

                    <?php
                        
                        $sql=  "SELECT * FROM account WHERE id_user = ?";
                        $options = [1];
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

                <form id="retrait" action="actions/convertion.php" method="post">

                    <p id="titre_retrait">🔀 Convertissez votre monnaie</p>
                    
                    <p class="info_input">Je convertis</p>

                    <div class="devise01">
                        <input type="text" name="amount" id="montant" placeholder="20">
                        <input type="text" name="currency" id="devise" placeholder="Devise">
                    </div>
                    
                    
                    <p class="info_input">Dans la devise :</p>

                    <input type="text" name="new_currency" id="" placeholder="EUROS - DOLLAR - BITCOIN">
                    
                    <p class="info_input">Confirmer votre mot de passe</p>
                    <input type="password" name="password" id="" placeholder="Saisissez votre mot de passe">
 
                    <button type="submit">Valider</button>

                </form>
            </div>
        </div>
</body>
</html>