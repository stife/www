<?php
session_start();
/*include "startseite.php";*/

$dsn = 'mysql:host=stife.lima-db.de;dbname=db_430521_1;charset=utf8';
$username = '{db-user}';
$password = '{password}';

try {
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('Datenbankverbindung fehlgeschlagen: ' . $e->getMessage());
}

// Prüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user_id']) && isset($_COOKIE['login_token'])) {
	$token = $_COOKIE['login_token'];

	// Benutzer anhand des Tokens abrufen
	$sql = "SELECT id FROM users WHERE login_token = :token";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':token', $token);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user) {
		// Automatische Anmeldung
		$_SESSION['user_id'] = $user['id'];
	}
}

if (!isset($_SESSION['user_id'])) {
	// Benutzer ist nicht eingeloggt, Weiterleitung zur Login-Seite
	header("Location: login.html");
	exit;
}

//echo $user['email ']; //"Willkommen $user . ['id']  ! Sie sind eingeloggt.";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($user)) {
	setcookie('email', $user['email'], time() + (86400 * 30), "/"); // 30 Tage gültig
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
<!--	<link rel="stylesheet" href="css/nav.css">
	<link rel="stylesheet" href="css/openai-dark.css">
-->
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

	<?php
	$page = $_GET['page'] ?? 'home'; // Standardseite ist "home"

	switch ($page) {
		case 'home':
			include 'startseite.php';
			break;
		case 'expresso':
			include 'expresso/index.php';
			break;
		case 'services':
			include 'startseite.php';
			break;
		case 'login':
			include 'login.html';
			break;
		case 'logout':
			include 'logout.php';
			break;
	/*	default:
			include 'pages/404.php'; // Fehlerseite
			break;*/
	}

	/**	include 'include/navigation.php'; /**/
	?>

</body>

</html>