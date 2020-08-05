<?php

	$timezone = date_default_timezone_set("Europe/Zagreb");

	$con = mysqli_connect("localhost", "id12836442_tonci", "webhostpass", "id12836442_webshop");

	mysqli_set_charset($con, 'utf8');

	if (mysqli_connect_errno()){
		echo "Neuspješno spajanje na bazu. " . mysqli_connect_errno();
	} else {
		echo "<!-- Spojen na bazu. -->";
	}

?>