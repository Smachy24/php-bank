
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/index.css">
    <title>Accueil</title>
</head>
<body>

    <header>
        <div id="back_header">

            <div id="logo">
                <img src="https://media.discordapp.net/attachments/301039123160891402/1069978978703646780/money-with-wings_1f4b8.png" alt="">
                <p>Bank Of Coding</p>
            </div>

            <div id="menu_fenetre">
                <form action="">
                    <button formaction="index.php">Accueil</button>
                    <button formaction="retrait.html">Retrait</button>
                    <button formaction="depot.php">Dépôt</button>
                    <button formaction="virement.html">Virement</button>
                    <button formaction="account.html">Compte</button>
                </form>
            </div>

        </div>
    </header>

        <div id="real_body">
            <div id="retrait_back">
                <form id="retrait" action="actions/deposit.php" method="post">

                    <p id="solde">💸 Votre solde est de : <span>1024€</span></p>
                    <p id="titre_retrait">🔼 Effectuer un dépôt d'argent :</p>
                    
                    <p class="info_input">Devise du dépôt</p>
                    <input type="text" name="currency" id="" placeholder="EUROS - DOLLAR - BITCOIN">
                    
                    <p class="info_input">Montant du dépôt</p>
                    <input type="text" name="amount" id="" placeholder="20">

                    <button type="submit">Valider</button>


                </form>
            </div>
        </div>

    <footer>
        <div id="back_footer">
            <p>Copyright 2023 - Fait par Mathis, Diego, Marko & Khaled</p>
        </div>
    </footer>

</body>
</html>