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
        //echo "la fonction a été appelé";
        global $db;
        global $dbManager;        

        $sql = 'SELECT '.$myTable.'.'.$myTable.'_id, user.fullname,currency.name,'.$myTable.'.amount,'.$myTable.'.date
                FROM '.$myTable.'
                JOIN currency
                ON '.$myTable.'.id_currency = currency.currency_id
                JOIN user
                ON '.$myTable.'.id_user = user.user_id
                ORDER BY date';


        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();
        
        //var_dump($result);

        foreach ($result as $row) {
            echo '<tr>
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["name"] . ' </th>
                    <th> ' . $row["amount"] . ' </th>
                    <th> ' . $row["date"] . ' </th>
                    <th> <a href="/actions/accept_transaction.php?id_transaction='. $row[$myTable . '_id'] .'&type_transaction='. $myTable .'"> valider </a> </th>
                    <th> <a href="/actions/delete_transaction.php?id_transaction='. $row[$myTable . '_id'] .'&type_transaction='. $myTable .'"> Refuse </a> </th>
                </tr>';
        }    
    }

    function gen_role_table()
    {
        global $db;
        global $dbManager;        

        $sql = 'SELECT user_id, fullname, role, email, created_at
                FROM user
                WHERE role = 1
                ORDER BY created_at';


        $req = $db->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();

        foreach ($result as $row) {
            echo '<tr>
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["role"] . ' </th>
                    <th> ' . $row["email"] . ' </th>
                    <th> ' . $row["created_at"] . ' </th>
                    <th> <a href="/actions/role_validation.php?verification_status=verified&id_user_to_check='.$row['user_id'].'"> verifier </a> </th>
                    <th> <a href="/actions/role_validation.php?verification_status=ban&id_user_to_check='.$row['user_id'].'"> ban </a> </th>
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

<!-- where id n'est pas egale a pas session user_id -->
<!-- un bouton peut avoir une value -->
<!-- on ne peut pas ban un admin ou un manager  -->





