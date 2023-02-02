

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


<!-- TABLEAU DES Deposit -->

<section id="score_table_section">
        <!-- formulaire pour gerer le sorting -->
        <form action="/index.php?page=dashboard_manager" method="POST">  

            <div class="form_section">
                <label>sorting</label>
                <select name="sorting">
                    <option value="date">date</option>
                    <option value="montant">montant</option>
                    <option value="fullname">nom</option>
                    <option value="currency">currency</option>
                </select>
            </div>

            <div>
                <input type="submit" id="valider" value="Valider" name="sorting_submit">
            </div>
        </form>

        <!-- formulaire pour etre en mode vision des scores personnel uniquement -->

        <table>
            <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Monaie</th>
                    <th>Montant</th>
                    <th>Date demande</th>
                </tr>
            </thead>

            <!-- pour chaque ligne de la tale cible, on va l'affecter a la variable $row et lui appliquer un traitement pour qu'elle affiche (echo) les donnée de colones dans différent balises <th> -->
            <tbody>
                <?php
                $sorting = "date";
                if (isset($_POST['sorting'])) {
                    $sorting = $_POST['sorting'];
                }

                genScores('deposit', $sorting);

                ?>
            </tbody>
        </table>
    </section>

