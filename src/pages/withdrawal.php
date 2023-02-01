
<body>


        <div id="real_body">
            <div id="retrait_back">
                <form id="retrait" action="actions/withdrawal.php" method="post">

                    <p id="solde">💸 Votre solde est de : <span>1024€</span></p>
                    <p id="titre_retrait">🔽 Effectuer un retrait d'argent :</p>
                    
                    <p class="info_input">Devise du retrait</p>
                    <input type="text" name="currency" id="" placeholder="EUROS - DOLLAR - BITCOIN">
                    
                    <p class="info_input">Montant du retrait</p>
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