

<?php 
    //require_once __DIR__ . '/utils/gen_manager_table.php';
    // require_once __DIR__ . '/../src/utils/gen_manager_table.php';
    //if (!(user['role'] > 1000))
    if (!$user) {
        header('Location: /index.php?page=login');
        die();
    }

    $errors = get_errors();
?>

<h1>Pannel Manager</h1>
<h3> Bonjour Manager <?php echo $user['fullname']; ?> ! </h3>

    <?php gen_table_structure("deposit") ?>
    <br>
    <?php //gen_table_structure("withdrawal") ?>


