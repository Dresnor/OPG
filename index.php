<?php 
session_start();

// define variables and set to empty values
$nameErr = $emailErr = $addressErr = "";
$email = $name = $address = "";

/*  local connect  
$connect = mysqli_connect("localhost", "root", "", "webshop");
		$_SESSION['orderedName'] = array();
		$_SESSION['orderedQuantity'] = array();
		$_SESSION['orderedPrice'] = array(); 

*/

/* server connect */
	$connect = mysqli_connect("localhost", "id12836442_tonci", "webhostpass", "id12836442_webshop");
	$_SESSION['orderedName'] = array();
	$_SESSION['orderedQuantity'] = array();
	$_SESSION['orderedPrice'] = array(); 
 
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
		$count = count($_SESSION["shopping_cart"]);
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
		echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
		'item_id'		=>	$_GET["id"],
		'item_name'		=>	$_POST["hidden_name"],
		'item_price'		=>	$_POST["hidden_price"],
		'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
 
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
		if($values["item_id"] == $_GET["id"])
		{
		unset($_SESSION["shopping_cart"][$keys]);
		echo '<script>window.location="index.php"</script>';
		}
		}
	}
}
 
?>
<!DOCTYPE html>
<html>

	<head>
		<title>OPG Zajec</title>
		<meta name="description" content="Zen laboratorij u sklopu gospodarstva na prirodan način prerađuje koprivu u zdrave proizvode kao što su tinkture, čajevi, sokovi, kozmetički proizvodi, odjevni predmeti te još mnogo toga..."> 
		<meta property="og:type" content="website" />
		<meta property="og:title" content="OPG Zen" />
		<meta property="og:description" content="Zen laboratorij na prirodan način prerađuje koprivu u zdrave proizvode kao što su tinkture, čajevi, sokovi, kozmetički proizvodi, odjevni predmeti te još mnogo toga..." />
		<!--<meta property="og:url" content="http://handabaka-tonci.gsz.avalon.hr" />-->
		<meta property="og:site_name" content="OPG Zen" />
		<meta property="og:image" content="http://handabaka-tonci.gsz.avalon.hr/img/cover3.jpg" />
		<meta name="author" content="Tonći Handabaka">
		<meta name="keywords" content="opg, kopriva, ekološka proizvodnja, organska, zen, web shop, dostava, hrana, kozmetika">
		<script src="https://kit.fontawesome.com/07d05f7c55.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css?"><!--   za online--> 
		<link rel="shortcut icon" href="img/logoFinal2.png"/> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
			<div class="intro">
				Zen laboratorij u sklopu gospodarstva na prirodan način prerađuje koprivu u zdrave proizvode kao što su tinkture, čajevi, sokovi, kozmetički proizvodi, odjevni predmeti te još mnogo toga...
			</div>
		</div> 
		<div class="thinLine sideBord">
		</div>
		
		<div class="anchor">
		</div>
		<div class="categories sideBord">
			<a href="#" class="categoriesSelection forAnimate" id="health"><div>Zdravlje</div></a>
			<a href="#" class="categoriesSelection forAnimate" id="beauty"><div>Ljepota</div></a>
			<a href="#" class="categoriesSelection forAnimate" id="food"><div>Hrana i Napici</div></a>
		</div>
	
		<div class="php">
			<?php
			if(!empty($_SESSION["shopping_cart"]))
			{
			$_SESSION['total'] = 0;
			echo '<div style="clear:both">
			<br />
			<span><h3 id="vasaKosarica">Vaša košarica <i class="fas fa-cart-arrow-down" style="font-size:22px"></span></i></h3>
			<br>
			<div class="table-responsive">
			<table class="table table-bordered kosarica">
			<tr>
			<th width="40%">Ime proizvoda</th>
			<th width="10%">Količina</th>
			<th width="20%">Cijena</th>
			<th width="15%">Ukupno</th>
			<th width="5%"></th>
			</tr>
			';
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
			?>
			<tr>
			<td class="wrap"><?php echo $values["item_name"];?></td>
			<td><?php echo $values["item_quantity"];?></td>
			<td> <?php echo $values["item_price"];?>kn</td>
			<td> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?>kn</td>
			<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Ukloni</span></a></td>
			</tr>
			<?php
			$_SESSION['total'] = $_SESSION['total'] + ($values["item_quantity"] * $values["item_price"]);
			array_push($_SESSION['orderedName'], $values["item_name"]);
			array_push($_SESSION['orderedQuantity'], $values["item_quantity"]);
			array_push($_SESSION['orderedPrice'], $values["item_price"]);
			}
			?>
			<tr>
			<td colspan="3" align="right">Ukupan iznos:</td>
			<td align="right"> <?php echo number_format($_SESSION['total'], 2); ?>kn</td>
			<td></td>
			</tr>
			<?php }
			echo '
			</table>';
			if (isset($values["item_name"])) {
					echo '<!-- Trigger/Open The Modal -->
					<div class="buttonWrapper">
						<button id="myBtn">Pošalji Narudžbu</button>
					</div>';'
			</div>
			</div>'
				?>
				<?php 
				} ?>
			</div>
			<!-- The Modal -->
			<div id="myModal" class="modal">
			<!-- Modal content -->
			<div class="modal-content">
					<div class="orderFormLeft">
						<p>Odabrani artikli:</p><hr>
						<?php
							for ($i = 0; $i < count($_SESSION['orderedName']); $i++) {
						echo $i + 1 . '. ' . $_SESSION['orderedName'][$i] . ', Količina: ' . $_SESSION['orderedQuantity'][$i] . ', Cijena: ' . $_SESSION['orderedPrice'][$i] . '<hr>';
							}
							if (isset($_SESSION['total'])) {
							echo 'Ukupno: ' . $_SESSION['total'] . ' kn';
						}
						?>
					</div>

					<div class="orderFormRight">	
					<p><span class="error">* Sva polja su obavezna <br>Plaćanje se vrši isključivo pouzećem.</span></p>
						<form id="orderForm" name="orderForm" action="clearSession.php" onsubmit="return validateForm();" method="post">
							<span class="error"><?php echo $nameErr;?></span>
							<input class="requiredInput" type="text" name="name" value="<?php echo $name ?>" placeholder="Ime i Prezime"><br><hr>
							<span class="error"><?php echo $emailErr;?></span>
							<input class="requiredInput" type="text" name="email" placeholder="email" value="<?php echo $email ?>"><br><hr>
							<span class="error"><?php echo $addressErr;?></span>
							<textarea class="requiredInput" rows="4" cols="40" name="address" placeholder="Adresa" value="<?php echo $address ?>"></textarea>
							<br><br>
							<div class="zaInput">
							<input type="submit" name="submit" value="Potvrdi narudžbu" id="potvrdiNarudzbu">
							</div>
						</form>
					</div>	<span class="close">&times;</span>
			</div>
			</div> <!-- Modal End -->
		<div class="sectionHeader hide" id="zdravljeHeader">
			<p class="pSectionHeader">Proizvodi za zdravlje...</p>
		</div>
			<div class="sectionHeader hide" id="ljepotaHeader">
			<p class="pSectionHeader">Proizvodi za ljepotu i zdravlje...</p>
		</div>
			<div class="sectionHeader hide" id="hranaHeader">
			<p class="pSectionHeader">Hrana i piće...</p>
		</div>

		<!-- ZDRAVLJE -->
		<div class="shopGallery" id="zdravlje">
			<?php
			$query = "SELECT * FROM proizvodi WHERE kategorija = 1";
			$result = mysqli_query($connect, $query);
			if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_array($result))
			{
			?>
			<div class="col-md-4">
				<form method="post" class="productsForm" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:2px solid #5b5959; background-color:whitesmoke; border-radius:5px; padding:16px; margin-bottom:7px;" align="center">
						
						<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
							<div class="transp">
					<img src="<?php echo $row["slika"]; ?>" class="img-responsive">
					</a><div class="text">Više informacija</div>
							</div><br />
						<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
					<h4 class="text-info"><?php echo $row["ime"]; ?></h4>
						</a>
					<h4 class="text-danger text-danger2"> <?php echo $row["cijena"]; ?>kn</h4>
			
					<input type="number" name="quantity" value="1" class="form-control" min="1" max="99"/>
			
					<input type="hidden" name="hidden_name" value="<?php echo $row["ime"]; ?>" />
			
					<input type="hidden" name="hidden_price" class='hiddenPrice<?php echo $row["id"]; ?>' value="<?php echo $row["cijena"]; ?>" />
			
					<input type="submit" name="add_to_cart" class='addToCart<?php echo $row["id"]; ?>' style="margin-top:5px;" class="btn btn-success" value="Dodaj u košaricu" />

					</div>
				</form>
			</div>
			<?php
			} 
			}
			?>
		</div> <!-- shop gallery end-->

		<!-- LJEPOTA -->
		<div class="shopGallery2 hide" id="ljepota">
		<?php
		$query = "SELECT * FROM proizvodi WHERE kategorija = 2";
		$result = mysqli_query($connect, $query);
		if(mysqli_num_rows($result) > 0)
		{
		while($row = mysqli_fetch_array($result))
		{
		?>
		<div class="col-md-3">
			<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
				<div style="border:2px solid #5b5959; background-color:whitesmoke; border-radius:5px; padding:16px; margin-bottom:7px;" align="center">
					
					<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
						<div class="transp">
				<img src="<?php echo $row["slika"]; ?>" class="img-responsive">
				</a><div class="text">Više informacija</div>
						</div><br />
					<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
				<h4 class="text-info"><?php echo $row["ime"]; ?></h4>
					</a>
				<h4 class="text-danger"> <?php echo $row["cijena"]; ?>kn</h4>
		
				<input type="number" name="quantity" value="1" class="form-control" min="1" max="99"/>
		
				<input type="hidden" name="hidden_name" value="<?php echo $row["ime"]; ?>" />
		
				<input type="hidden" name="hidden_price" class='hiddenPrice<?php echo $row["id"]; ?>' value="<?php echo $row["cijena"]; ?>" />
		
				<input type="submit" name="add_to_cart" class='addToCart<?php echo $row["id"]; ?>' style="margin-top:5px;" class="btn btn-success" value="Dodaj u košaricu" />
		
				</div>
			</form>
		</div>
			
		<?php
		} 
		}
		?>
		</div> <!-- shop gallery2 end-->

		<!-- HRANA I NAPICI --> 
		<div class="shopGallery hide" id="hrana">
			<?php
			$query = "SELECT * FROM proizvodi WHERE kategorija = 3";
			$result = mysqli_query($connect, $query);
			if(mysqli_num_rows($result) > 0)
			{
			while($row = mysqli_fetch_array($result))
			{
			?>
			<div class="col-md-4">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:2px solid #5b5959; background-color:whitesmoke; border-radius:5px; padding:16px; margin-bottom:7px;" align="center">
						<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
							<div class="transp">
								<img src="<?php echo $row["slika"]; ?>" class="img-responsive">
							</div> 
						</a>
						<div class="text">Više informacija
						</div>
					</div><br />
					<a href="produkt.php?id=<?php echo $row["id"]?>#productAnchor">
						<h4 class="text-info"><?php echo $row["ime"]; ?></h4>
					</a>
					<h4 class="text-danger text-danger2"> <?php echo $row["cijena"]; ?>kn</h4>
		
					<input type="number" name="quantity" value="1" class="form-control" min="1" max="99"/>
			
					<input type="hidden" name="hidden_name" value="<?php echo $row["ime"]; ?>" />
			
					<input type="hidden" name="hidden_price" class='hiddenPrice<?php echo $row["id"]; ?>' value="<?php echo $row["cijena"]; ?>" />
			
					<input type="submit" name="add_to_cart" class='addToCart<?php echo $row["id"]; ?>' style="margin-top:5px;" class="btn btn-success" value="Dodaj u košaricu" />

					<!-- disable Prices --- i < no. has to be at least number of products -->
					<script>
						for (let i = 1 ; i < 30; i++) {
						var hPrice = document.querySelector(`.hiddenPrice${i}`);
						var addToCart = document.querySelector(`.addToCart${i}`);
							if (hPrice.value == 0) {
							addToCart.disabled = true;
						}
					}	
					</script>
				</form>
			</div> <!-- col end -->
			<?php
			} 
			}
			?>
		</div> <!-- shop gallery -->

		<div class="largeButton">
    		<button type="button" class="btn btn-secondary btn-lg toTop">Povratak na vrh</button>
  		</div>
		<br/>
	
		<footer id="footer">
			Design by: TH &copy; 2020
		</footer>
	</div> <!--wrapper end-->
	<div>testirajmo</div>
	<script>

//provjera unosa forme
$(document).ready(function() {

	$("#orderForm").submit(function(){
		var isFormValid = true;
		$(".requiredInput").each(function(){
			if ($.trim($(this).val()).length == 0){
				$(this).addClass("highlight");
				isFormValid = false;
			}
			else{
				$(this).removeClass("highlight");
			}
		});
		if (!isFormValid) alert("Molimo ispunite sva polja");
		return isFormValid;
	});

//sa izbornika na galeriju

	$('.forAnimate').click(function() {
	  $('html, body').animate({
	    scrollTop: $("div.anchor").offset().top
	  }, 1000)
	});
	$(".toTop").click(function() {
	    $("html, body").animate(
	    {
	      scrollTop:0
	    }, 800);
	  });

//toggle izbora i naslova
	$('#health').click(function() {
	  $('#zdravlje').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
	  $('#zdravlje').removeClass('hide');
	  $('#ljepota').addClass('hide');
	  $('#hrana').addClass('hide');
	  $('#zdravljeHeader').removeClass('hide');
	  $('#hranaHeader').addClass('hide');
	  $('#ljepotaHeader').addClass('hide');
	});

	$('#beauty').click(function() {
	  $('#ljepota').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
	  $('#ljepota').removeClass('hide');
	  $('#zdravlje').addClass('hide');
	  $('#hrana').addClass('hide');
	  $('#ljepotaHeader').removeClass('hide');
	  $('#zdravljeHeader').addClass('hide');
	  $('#hranaHeader').addClass('hide');	
	});

	$('#food').click(function() {
	  $('#hrana').css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
	  $('#hrana').removeClass('hide');
	  $('#zdravlje').addClass('hide');
	  $('#ljepota').addClass('hide');
	  $('#hranaHeader').removeClass('hide');
	  $('#zdravljeHeader').addClass('hide');
	  $('#ljepotaHeader').addClass('hide');
	});

});

function validateForm() {
	if (!validirajAdresuEPoste(document.orderForm.email.value)) {
		alert("Unesite ispravnu email adresu");
		return false;
	}
}	
function validirajAdresuEPoste(eposta){
	var regulaEmail = /^.+@.+\.[a-z]{2,}/;
	if (!regulaEmail.test(eposta)){
		return false;
	}
	return true;
}	

// Get the modal
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>
