<?php 
require_once __DIR__ . '/../src/init.php';


$errors = get_errors();


$page_title = 'Créer un compte';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>

    <?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
    
    <?php
	if ($errors !== false) {
		echo '<p>'.$errors.'</p>';
	} ?>

	<div id="real_body">
            <div id="retrait_back05">
                <form id="retrait" action="/actions/register.php" method="post">

                    <p id="titre_retrait">👤 Créer un compte</p>
                    
                    <p class="info_input">Nom Complet </p>
                    <input type="text" name="fullname" id="" placeholder="Paul Dumont">

                    <p class="info_input">Email</p>
                    <input type="text" name="email" id="" placeholder="name@mail.com">
                    
                    <p class="info_input">Mot de passe</p>
                    <input type="password" name="password" id="" placeholder="Saisissez votre mot de passe">

                    <p class="info_input">Confirmer votre mot de passe</p>
                    <input type="password" name="cpassword" id="" placeholder="Saisissez votre mot de passe">

                    <button type="submit">Valider</button>
                    <p class="info_input">Déjà un compte ? Cliquer <a href="login.php">ici</a></p>


                </form>
            </div>
        </div>

	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>