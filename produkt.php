<?php
include("include/config.php");
include("include/produkt_constructor.php");

  if(isset($_GET['id'])) {
    $produktId = $_GET['id'];
  }
  else {
    header("Location: index.php");
  }

$produkt = new produkt_constructor($con, $produktId);
$ime = $produkt->getIme();
$opis = $produkt->getOpis();
$kategorija = $produkt->getKategorija();
$kolicina = $produkt->getKolicina();
$cijena = $produkt->getCijena();
$slika = $produkt->getSlika();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Produkt | Baze 4</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width; initial-scale=1.0;">
	<meta charset="utf-8">
	<meta name=“viewport” content=“width=device-width, initial- scale=1.0”>
	<meta name="robots" content="Noindex">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css?ver=100">
	<link rel="shortcut icon" href="img/logoFinal2.png"/> 
</head>
<body>
<div class="wrapper">	
<nav class="sideBord">
	<a href="index.php" class="pocetna">Početna</a>
	<a href="oNama.html" class="oNama">O Nama</a>
	<a href="kontakt.html" class="kontakt">Kontakt</a>
	<div id="secondPart">
	</div>
</nav>
	<div class="cover sideBord">
	<div class="headline">
			<a href="index.php" style="flex:22%"><img src="img/logoFinal2.png" id="logoLarge" alt="Zen logo">
		<img src="img/logoFinal2.png" id="logoMedium" alt="Zen logo"></a>
			<div align="center" class="headline2">
				<h3 >WEB Trgovina OPG Zajec</h3>
				<h5 align="center">EKOLOŠKA PROIZVODNJA KOPRIVE</h5>
			</div>	
	</div>

<div id="povratakDiv">
<a href="index.php" class="link">
<p id="back">Povratak</p>
</a>
</div>
</div>
<div class="thinLine"></div>
<div id="productAnchor"></div>
<div class="wrapperProdukt"> 
	<div class="productImage">
		<img src="<?php echo $slika?>" id="proizvodSlika">
	</div>
	<div class="info">
		<p class="importedInfoHeading"><?php echo $ime;?></p>
		<hr>
		<p class="infoHeadings">Opis Proizvoda:</p>
		<hr style="background-color: #cfcbcb;margin:0">
		<p class="importedInfo" id="opis"><?php echo $opis;?></p>
		<hr>
		<p class="price">Cijena: <?php echo $cijena;?>kn</p>
	</div>
</div>

	<footer id="footer">
		Design by: TH &copy; 2020
	</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</div>
</body>
</html>