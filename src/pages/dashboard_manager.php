

<?php 
    //require_once __DIR__ . '/utils/gen_manager_table.php';
    // require_once __DIR__ . '/../src/utils/gen_manager_table.php';
    //if (!(user['role'] > 1000))
    if (!$user) {
        header('Location: /index.php?page=login');
        die();
    }
    elseif($user['role'] < 200)
    {
        header('Location: /index.php?page=login');
        die();
    }

    $errors = get_errors();
?>

<h1>Pannel Manager</h1>
<h3> Bonjour Manager <?php echo $user['fullname']; ?> ! </h3>

    <h2>tableau demande de dépot</h2>
    <?php gen_table_structure("deposit") ?>
    <h2>tableau demande de retrait</h2>
    <?php gen_table_structure("withdrawal") ?>


    <h1>Pannel Validation</h1>
    <section id="manager_table_section">
        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>role</th>
                    <th>email</th>
                    <th>date création</th>
                </tr>
            </thead>

            <tbody>
                <?php gen_role_table() ?>
            </tbody>
        </table>
    </section>

    <?php 
    
    
    
    
    
    
    
    ?>


