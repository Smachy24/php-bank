<?php
require_once __DIR__ . '/../src/init.php';


$page_titles = [
	'home' => 'Accueil',
	'login' => 'Se connecter',
	'register' => 'S\'inscire',
    'dashboard_manager' => 'DashBoard Manager',
    'deposit'=>"Dépôt",
    'withdrawal'=>"Retrait"
];


// -- Ensemble des pages possible -- //
// pages accessibles si on est pas co
$loggedout_pages = ['login', 'register'];
// pages accessibles si on est co:
$loggedin_pages = ['home', 'deposit', 'withdrawal'];
// pages qui sont accessibles a tous
$everyone_pages = [];
// pages qui sont uniquement accessibles aux managers et admins
$manager_pages = ['dashboard_manager'];
// pages qui sont uniquement accessibles aux admins
$admin_pages = [];

//Si on arrive sur l'index.php en brut on evite les erreurs lié au fait qu'il n'y ait aucun parametre d'url
if (!isset($_GET['page']))
{
    $page = "home";
}
else
{
    // verification le contenu de $_GET['page'] du plus spécifique au plus générale
    if (in_array($_GET['page'], $admin_pages)) {
        $page = $_GET["page"];
    }
    elseif (in_array($_GET['page'], $manager_pages)) {
        $page = $_GET["page"];
    }
    elseif (in_array($_GET['page'], $loggedin_pages)) {
        $page = $_GET["page"];
    }
    elseif (in_array($_GET['page'], $loggedout_pages)) {
        $page = $_GET['page'];
    }
    elseif (in_array($_GET['page'], $everyone_pages)) {
        $page = $_GET['page'];
    }
    else {
        //si le user essaye de rentrer des parametre d'url inconnue, renvoie sur home
        $page = "home";
    }
}

//Affectation du bon nom d'onglet pour la page
$page_title = $page_titles[$page];

//import <head>
require_once __DIR__ . '/../src/partials/header.php'; 
?>

<body>
    <?php require_once __DIR__ . '/../src/partials/nav.php'; ?>
    <?php require_once __DIR__ . '/../src/pages/' . $page . '.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>