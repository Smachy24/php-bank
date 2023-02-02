
<?php 

    function gen_table_structure($myTable)
    {
        echo
        '
        <section id="manager_table_section">
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Monaie</th>
                    <th>Montant</th>
                    <th>Date demande</th>
                </tr>
            </thead>

            <tbody>
         ';

        gen_table_content($myTable); 
           
        echo '
            </tbody>
        </table>
    </section>
    ';
    }
    


    function gen_table_content($myTable)
    {
        echo "la fonction a été appelé";
        global $db;
        global $dbManager;        

        switch ($myTable)
        {
            case "deposit":
                $sql = 'SELECT deposit.deposit_id, user.fullname,currency.name,deposit.amount,deposit.date
                FROM deposit
                JOIN currency
                ON deposit.id_currency = currency.currency_id
                JOIN user
                ON deposit.id_user = user.user_id
                ORDER BY date DESC';
                break;
                

            case "withdrawal":
                $sql = 'SELECT withdrawal.withdrawal_id, user.fullname,currency.name,withdrawal.amount,withdrawal.date
                FROM withdrawal
                JOIN currency
                ON withdrawal.id_currency = currency.currency_id
                JOIN user
                ON withdrawal.id_user = user.user_id
                ORDER BY date DESC';
                break;


            case "modulaire":
                break;



        }


        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();
        
        var_dump($result);

        foreach ($result as $row) {
            echo '<tr>
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["name"] . ' </th>
                    <th> ' . $row["amount"] . ' </th>
                    <th> ' . $row["date"] . ' </th>
                    <th> <a href="/actions/accept_transaction.php?id_transaction='. $row['deposit_id'] .'"> valider </a> </th>
                    <th> <a href="/actions/refuse_transaction.php?id_transaction='. $row['deposit_id'] .'"> Refuse </a> </th>
                </tr>';
        }    
    }



    function genScores($myTable, $mySorting)
    {

        global $db;
        global $dbManager;

        if (isset($mySorting)) {
            $sortingScores = $mySorting;
        } else {
            $sortingScores = "date";
        }

        //premiere fonctionelle
        //$sql = 'SELECT * FROM ' . $myTable . '  ORDER BY ' . $sortingScores . ' DESC';
        

        $sql = 'SELECT deposit.deposit_id, user.fullname,currency.name,deposit.amount,deposit.date
        FROM deposit
        JOIN currency
        ON deposit.id_currency = currency.currency_id
        JOIN user
        ON deposit.id_user = user.user_id
        ORDER BY date DESC';




        // $sql = 'SELECT user.fullname, currency.name,  deposit.amount, deposit.date 
        // FROM deposit 
        // JOIN user 
        // ON deposit.id_user = user.user_id 
        
        // JOIN currency 
        // ON deposit.id_currency = currency.currency_id
        
        // ORDER BY date DESC';

       // $sql = 'SELECT * FROM deposit INNER JOIN user ON deposit.id_user = user.user_id ORDER BY ' . $sortingScores . ' DESC';
     //  $sql = 'SELECT * FROM ' . $myTable . ' INNER JOIN user ON '. $myTable .'.id_user ORDER BY ' . $sortingScores . ' DESC';

        //$result = $dbManager -> select($sql, []);

        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();
        
        var_dump($result);

        foreach ($result as $row) {
            echo '<tr>
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["name"] . ' </th>
                    <th> ' . $row["amount"] . ' </th>
                    <th> ' . $row["date"] . ' </th>
                    <th> <a href="/actions/accept_transaction.php?id_transaction='. $row['deposit_id'] .'"> valider </a> </th>
                    <th> <a href="/actions/refuse_transaction.php?id_transaction='. $row['deposit_id'] .'"> Refuse </a> </th>
                </tr>';
        }
    }
?>


<!-- un bouton peut avoir une value -->






