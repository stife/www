<?php
session_start();
require 'include/variablen.php';
// Dynamisch festgelegte Datei
//$content_url = isset($_GET['seite']) ? $_GET['seite'] : 'startseite.php';
//
//if (in_array($content_url, $erlaubte_dateien)) {
	// Datei sicher einbinden
//	include "content/" . $content_url;
//} else {
	// Fehlerseite anzeigen, wenn die Datei nicht erlaubt ist
	//echo "Die angeforderte Seite existiert nicht.";
//}
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<!--
	<script src="https://cdn.jsdelivr.net/npm/eruda"></script>
	<script>eruda.init();</script>
	-->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<style>
		/* Alle Abschnitte standardmäßig ausblenden */
		section.cont {
			display: none;
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['email'])): ?>
	<div class="user-info">
		Eingeloggt als: <?= htmlspecialchars($_SESSION['email']); ?>
	</div>
	<?php endif; ?>
	<!--div class="header_content"-->
	<header>
		<div class="header_content">
			<h1><?php echo $titel; ?></h1>
			<!--Navigationsleiste eingefügt -->
			<?php include 'include/navigation.php'; ?>
		</div>
	</header>
</div>
<main>
	<div class="main">
		<section class="cont" id="home">
			<h2><?php echo $title_home; ?></h2>
			<p>
				<?php echo $content_home; ?>
			</p>
		</section>
		<section class="cont" id="expresso">
			<!--	<h2><?php //echo $title_services; ?></h2>-->
			<p>
				<?php
				include $expresso;
				?>
			</p>
		</section>
		<section class="cont" id="aufgaben">
			<h2><?php echo $title_aufgabenliste; ?></h2>
			<p>
				<?php include $content_aufgabenliste; ?>
			</p>
		</section>
		<section class="cont" id="login">
			<h2><?php echo $title_login; ?></h2>
			<p>
				<?php include $content_login; ?>
			</p>
		</section>
	</div>
</main>

<footer>
	<p>
		&copy; 2024 <?php echo $title; ?>
	</p>
</footer>
<!--/div> -->

<script>
	function zeigeAbschnitt(abschnittId) {
		// Alle Abschnitte ausblenden
		var abschnitte = document.querySelectorAll('section.cont');
		abschnitte.forEach(function(abschnitt) {
			abschnitt.style.display = 'none';
		});

		// Gewählten Abschnitt einblenden
		var gewaehlterAbschnitt = document.getElementById(abschnittId);
		if (gewaehlterAbschnitt) {
			gewaehlterAbschnitt.style.display = 'block';
			// Zum Abschnitt scrollen
			gewaehlterAbschnitt.scrollIntoView({
				behavior: 'smooth'
			});
		}
	}

	// Optional: Standardmäßig einen Abschnitt anzeigen
	document.addEventListener('DOMContentLoaded', function() {
		zeigeAbschnitt('home'); // 'home' durch die ID des gewünschten Standardabschnitts ersetzen
	});
</script>
<script>
	function zeigeAbschnitt(abschnittId) {
		// Alle Abschnitte ausblenden
		const abschnitte = document.querySelectorAll('section.cont');
		abschnitte.forEach(function(abschnitt) {
			abschnitt.style.display = 'none';
		});

		// Gewählten Abschnitt einblenden
		const gewaehlterAbschnitt = document.getElementById(abschnittId);
		if (gewaehlterAbschnitt) {
			gewaehlterAbschnitt.style.display = 'block';
			// Zum Abschnitt scrollen
			gewaehlterAbschnitt.scrollIntoView({
				behavior: 'smooth'
			});
		}
	}

	// Beim Laden prüfen, ob ein Hash in der Adresszeile steht.
	// Wenn ja, diesen Abschnitt anzeigen. Andernfalls 'home'.
	document.addEventListener('DOMContentLoaded', function() {
		const hash = window.location.hash.slice(1); // '#' entfernen
		if (hash) {
			zeigeAbschnitt(hash);
		} else {
			zeigeAbschnitt('home');
		}
	});
</script>
</body>
</html>
