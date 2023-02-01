<?php 
require_once __DIR__ . '/../src/init.php';


$errors = get_errors();

$page_title = 'Connectez-vous';
require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
	<?php require_once __DIR__ . '/../src/partials/menu.php'; ?>
	<?php require_once __DIR__ . '/../src/pages/login.php'; ?>
	<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>