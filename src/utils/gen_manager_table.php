<?php 

    function gen_table_structure($myTable)
    {
        echo
        '
        <section id="manager_table_section">
        <table class="tableau-style">
            <thead class="tableau-style">
                <tr class="name_column">
                    <th>Utilisateur</th>
                    <th>Monaie</th>
                    <th>Montant</th>
                    <th>Date demande</th>
                </tr>
            </thead>

            <tbody class="tbody">
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
            echo '<tr class="tableau_bas02">
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["name"] . ' </th>
                    <th> ' . $row["amount"] . ' </th>
                    <th> ' . $row["date"] . ' </th>
                    <th> <a style="text-decoration:none; font-size=x-large; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;" href="/actions/accept_transaction.php?id_transaction='. $row[$myTable . '_id'] .'&type_transaction='. $myTable .'"> ✅ </a> </th>
                    <th> <a style="text-decoration:none; font-size=x-large; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;" href="/actions/delete_transaction.php?id_transaction='. $row[$myTable . '_id'] .'&type_transaction='. $myTable .'"> ❌ </a> </th>
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
            echo '<tr class="tableau_bas02">
                    <th> ' . $row["fullname"] . '  </th>
                    <th> ' . $row["role"] . ' </th>
                    <th> ' . $row["email"] . ' </th>
                    <th> ' . $row["created_at"] . ' </th>
                    <th> <a style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; text-decoration:none; font-size=x-large;" href="/actions/role_validation.php?verification_status=verified&id_user_to_check='.$row['user_id'].'"> ✅ </a> </th>
                    <th> <a style="box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; text-decoration:none; font-size=x-large;" href="/actions/role_validation.php?verification_status=ban&id_user_to_check='.$row['user_id'].'"> ⛔️ </a> </th>
                </tr>';
        }    
    }

?>





