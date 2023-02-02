<H1>Acceuil</H1>

    <?php 
    if ($user) { ?>
        <h3> Bonjour <?php echo $user['fullname']; ?> ! </h3>
    <?php } ?>
