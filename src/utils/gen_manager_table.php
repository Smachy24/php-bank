
<?php 
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
        $sql = 'SELECT * FROM ' . $myTable . '  ORDER BY ' . $sortingScores . ' DESC';
        
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
                    <th> ' . $row["id_user"] . ' </th>
                    <th> ' . $row["id_currency"] . ' </th>
                    <th> ' . $row["amount"] . ' </th>
                    <th> ' . $row["date"] . ' </th>
                </tr>';
        }
    }
?>
