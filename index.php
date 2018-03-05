<?php

$typeBroodjes = ["Preparé", "Krab", "Kaas", "Hesp", "Kaas & Hesp", "Gezond", "Salami", "Kipfilet"];

?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<title>Broodjes met talent!</title>
</head>
<body class="bg-light">

	<div class="container">
		<div class="py-5 text-center">
			<img class="d-block mx-auto mb-4" src="https://www.talent-it.be/wp-content/uploads/2017/08/logo-talent-it-orange-2.png" alt="" width="200" height="45">
			<h2>Broodjes met talent!</h2>
			<p class="lead">Gelieve onderstaand formulier in te vullen om je broodjes te bestellen.</p>
		</div>

		<form method="POST" action="broodje_verwerken.php">
			<div class="row">
				<div class="col-md-4 order-md-2 mb-4">
					<h4 class="mb-3">Je gegevens</h4>

					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="cc-name">Naam</label>
							<input type="text" class="form-control" id="naam" placeholder="Bv. John Doe" required>
							<div class="invalid-feedback">
								Gelieve een naam in te vullen
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8 order-md-1">
					<h4 class="mb-3">Kies je broodjes</h4>
					<div id="broodjesContainer">
						<div class="row" id="broodje_1">
							<div class="col-md-2 mb-3">
								<label for="aantal_1">Aantal</label>
								<div id="aantalContainer">
									<input type="number" name="aantal_1" class="form-control mb-3" id="aantal_1" placeholder="1" value="1" required>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="grootte_1">Grootte</label>
								<div id="grootteContainer">
									<div class="input-group mb-3">
										<select class="custom-select" id="grootte_1" name="grootte_1">
											<option value="1" selected>Groot</option>
											<option value="0">Klein</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="smos_1">Smos</label>
								<div id="smosContainer">
									<div class="input-group mb-3">
										<select class="custom-select" id="smos_1" name="smos_1">
											<option value="1" selected>Ja</option>
											<option value="0">Nee</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="fitness_1">Fitness</label>
								<div id="fitnessContainer">
									<div class="input-group mb-3">
										<select class="custom-select" id="fitness_1" name="fitness_1">
											<option value="1" selected>Wit</option>
											<option value="0">Bruin</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="aantal_1">Type</label>
								<div id="typeContainer">
									<div class="input-group mb-3">
										<select class="custom-select" id="aantal_1" name="aantal_1">
											<?php
											foreach ($typeBroodjes as $broodje) {
												echo '<option value="' . $broodje . '">' . $broodje . '</option>';
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-default" id="addBrood">+ Voeg nog een broodje toe</button>

					<hr class="md4" />

					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="soepvdag" name="soepvdag">
						<label class="custom-control-label" for="soepvdag">Ik wil de soep van de dag (Broccolisoep).</label>
					</div>

					<hr class="md4" />

					<button class="btn btn-success btn-lg btn-block" type="submit">Bestel broodjes</button>
				</div>
			</div>
		</form>
		<footer class="my-5 pt-5 text-muted text-center text-small">
			<p class="mb-1">Geschreven met passie door Talent IT PHP Class 2018</p>
		</footer>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script type="text/javascript">
		
		var broodjesteller = 1;

		var aantalcode = $('#aantalContainer').html().replaceAll("aantal_1", "aantal_XXX");
		var groottecode = $('#grootteContainer').html().replaceAll("grootte_1", "grootte_XXX");
		var smoscode = $('#smosContainer').html().replaceAll("smos_1", "smos_XXX");
		var typecode = $('#typeContainer').html().replaceAll("type_1", "type_XXX");
		var fitnesscode = $('#fitnessContainer').html().replaceAll("fitness_1", "fitness_XXX");

		$(function() {
			$('#addBrood').on('click', function(e) {
				e.preventDefault();
				++broodjesteller;
				var myAantal = aantalcode.replaceAll("XXX", broodjesteller);
				var myGrootte = groottecode.replaceAll("XXX", broodjesteller);
				var mySmos = smoscode.replaceAll("XXX", broodjesteller);
				var myType = typecode.replaceAll("XXX", broodjesteller);
				var myFitness = fitnesscode.replaceAll("XXX", broodjesteller);
				$('#aantalContainer').append(myAantal);
				$('#grootteContainer').append(myGrootte);
				$('#smosContainer').append(mySmos);
				$('#typeContainer').append(myType);
				$('#fitnessContainer').append(myFitness);
			});
		});

	</script>
</body>
</html>