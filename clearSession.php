<?php
session_start();

$lista = array();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }
  
for ($i = 0; $i < count($_SESSION['orderedName']); $i++) {
	$lista[$i] = $i + 1 . '. ' . $_SESSION['orderedName'][$i] . ', Količina: ' . $_SESSION['orderedQuantity'][$i] . ', Cijena: ' . $_SESSION['orderedPrice'][$i] . '<hr>';
	}
	 
 $popis = "";
 
 foreach ($lista as $value){
    $popis .= $value;
    $popis .= "<br>";
}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address'])) {
	$name = test_input($_POST['name']);
	$email = test_input($_POST["email"]);
	$address = test_input($_POST['address']);
	$total = test_input($_SESSION['total']);
	$to = 'zajec1000@gmail.com';
	$subject = 'Narudžba';
	$message = "
	<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<p>Pozdrav! Dobili smo narudžbu od sljedećeg naručitelja:
	<br>
	<p>Ime i Prezime: " . $name . "</p>
	<p>Adresa: " . $address . "</p>
	<p>Email: " . $email . "</p>
	<br>
	<p>Naručeno: </p><br>" . $popis . "
	<p>Ukupna cijena: " . $total . ".00 kn</p>

	</body>
	</html>
	";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <Narudzba@opgzajec.com>' . "\r\n";

$send = mail($to,$subject,$message,$headers);
 
	if ($send) {
		echo '<!DOCTYPE html>
		<html>
		<head>
			<title>OPG Zajec</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">
	<meta name="robots" content="Noindex">
	<link rel="shortcut icon" href="img/logoFinal2.png.png"/> 
	<link rel="stylesheet" type="text/css" href="style.css?ver=100">
		</head>
		<body>
		<nav>
			<a href="index.php" class="pocetna">Početna</a>
			<a href="oNama.html" class="oNama">O Nama</a>
			<a href="kontakt.html" class="kontakt">Kontakt</a>
			<div id="secondPart">
			</div>
		</nav>
		<div class="cover">
		<div class="headline">
  			<a href="index.php" style="flex:22%"><img src="img/logoFinal2.png" id="logoLarge" alt="Zen logo">
  		<img src="img/logoFinal2.png" id="logoMedium" alt="Zen logo"></a>
  			<div align="center" class="headline2">
  				<h3>WEB Trgovina OPG Zajec</h3>
  				<h5 align="center">EKOLOŠKA PROIZVODNJA KOPRIVE</h5>
  			</div>	
		</div>
		<p class="zahvala">Zahvaljujemo na narudžbi. Uskoro ćemo Vam se javiti.</p>
		</body>
		</html>';
		
	} else {
		echo '<!DOCTYPE html>
		<html>
		<head>
			<title>OPG Zajec</title>
			<link rel="stylesheet" type="text/css" href="style.css?ver=100">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="shortcut icon" href="images/favicon.jpg"/> 
		</head>
		<body>
		<nav>
			<a href="index.php" class="pocetna">Početna</a>
			<a href="oNama.html" class="oNama">O Nama</a>
			<a href="kontakt.html" class="kontakt">Kontakt</a>
			<div id="secondPart">
			</div>
		</nav>
		<div class="cover">
		<div class="headline">
  			<a href="index.php" style="flex:22%"><img src="img/logoFinal2.png" id="logoLarge">
  		<img src="logoFinal2.png" id="logoMedium"></a>
  			<div align="center" class="headline2">
  				<h3>WEB Trgovina OPG Zajec</h3>
  				<h5 align="center">EKOLOŠKA PROIZVODNJA KOPRIVE</h5>
  			</div>	
		</div>
		<p class="zahvala">Narudžba nije uspjela. Možete nas kontaktirati na zajec1000@gmail.com</p>
		</body>
		</html>';
		
	}

	echo '<a href="index.php">
			<br>
			<div id="buttonZahvala">
			<button "style="padding:2px;margin:2px;">Povratak na stranicu</button></a>
			</div>';

	session_destroy();
	/*header("Location: potvrdaNarudzbe.php");*/
}

	

?>

