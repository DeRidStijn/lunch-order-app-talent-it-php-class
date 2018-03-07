<?php

require_once('Brood.php');
require_once('Order.php');
require_once __DIR__ . './config.php';

session_start();

// SETUP FOR PULLING ALL 'beleg' FROM DB

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

$stmt = $pdo->prepare('SELECT soep FROM soep WHERE id=' . date(N));
$stmt->execute();

$soep = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM beleg');
$stmt->execute();

$belegArr = $stmt->fetchAll();

$categorieStmt = $pdo->prepare('SELECT * FROM categorie');
$categorieStmt->execute();

$categorieArr = $categorieStmt-fetchAll();

$typeBroodjes = ["Preparé", "Krab", "Kaas", "Hesp", "Kaas & Hesp", "Gezond", "Salami", "Kipfilet"];

if(!empty($_SESSION['order'])) {
	$myOrder = $_SESSION['order'];
}

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
	<!-- Test area -->
	<?php

	/*foreach ($soepArr as $soep) {
		echo $soep['soep'];
	}
*/
	?>
	
	<div class="container">
		<div class="py-5 text-center">
			<img class="d-block mx-auto mb-4" src="https://www.talent-it.be/wp-content/uploads/2017/08/logo-talent-it-orange-2.png" alt="" width="200" height="45">
			<h2>Broodjes met talent!</h2>
			<p class="lead">Gelieve onderstaand formulier in te vullen om je broodjes te bestellen.</p>
		</div>
		<?php
			if (!empty($_SESSION['errors']) && [] !== $_SESSION['errors']) {
				foreach ($_SESSION['errors'] as $error) {
					?>
					<div class="alert alert-danger">
						<?php
						foreach ($error as $errormessage) {
							echo $errormessage . '<br />';
						}
						?>
					</div>
					<?php
				}
				$_SESSION['errors'] = [];
				unset($_SESSION['errors']);
			}

			if (!empty($_SESSION['success']) && "" !== $_SESSION['success']) {
				?>
				<div class="alert alert-success">
					<?php
					echo $_SESSION['success'];
					?>
				</div>
				<?php
				$_SESSION['success'] = "";
				unset($_SESSION['success']);
			}
		?>
		<form method="POST" action="broodje_verwerken.php">
			<input type="number" value="1" id="aantalbroodjes" name="aantalbroodjes" style="display: none;" />
			<div class="row">
				<div class="col-md-4 order-md-2 mb-4">
					<h4 class="mb-3">Je gegevens</h4>

					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="cc-name">Naam</label>
							<input type="text" class="form-control" id="naam" name="naam" placeholder="Bv. John Doe" <?php
							if(!empty($myOrder)) {
								echo 'value="' . $myOrder->getNaam() . '"';
							} ?> required>
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
								<div id="addMeAantal" style="display: none;">
									<input type="number" name="aantal_1" class="form-control mb-3" id="aantal_1" placeholder="1" value="1" required>
								</div>
								<div id="aantalContainer">
									<?php
									if(!empty($myOrder)) {
										$broodjesteller = 0;
										foreach ($myOrder->getBroodjes() as $broodje) {
											$broodjesteller++;
											?>
											<input type="number" name="aantal_<?php echo $broodjesteller; ?>" class="form-control mb-3" id="aantal_<?php echo $broodjesteller; ?>" placeholder="1" value="<?php echo $broodje->getAantalBroodjes(); ?>" required>
											<?php
										}
									} else {
										?>
										<input type="number" name="aantal_1" class="form-control mb-3" id="aantal_1" placeholder="1" value="1" required>
										<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="grootte_1">Grootte</label>
								<div id="addMeGrootte" style="display: none;">
									<div class="input-group mb-3">
										<select class="custom-select" id="grootte_1" name="grootte_1">
											<option value="1" selected>Groot</option>
											<option value="0">Klein</option>
										</select>
									</div>
								</div>
								<div id="grootteContainer">
									<?php
									if(!empty($myOrder)) {
										$broodjesteller = 0;
										foreach ($myOrder->getBroodjes() as $broodje) {
											$broodjesteller++;
											?>
											<div class="input-group mb-3">
												<select class="custom-select" id="grootte_<?php echo $broodjesteller; ?>" name="grootte_<?php echo $broodjesteller; ?>">
													<option value="1" <?php if($broodje->getBaguette() === 1) { echo 'selected'; } ?>>Groot</option>
													<option value="0" <?php if($broodje->getBaguette() === 0) { echo 'selected'; } ?>>Klein</option>
												</select>
											</div>
											<?php
										}
									} else {
										?>
										<div class="input-group mb-3">
											<select class="custom-select" id="grootte_1" name="grootte_1">
												<option value="1" selected>Groot</option>
												<option value="0">Klein</option>
											</select>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="smos_1">Smos</label>
								<div id="addMeSmos" style="display: none;">
									<div class="input-group mb-3">
										<select class="custom-select" id="smos_1" name="smos_1">
											<option value="1" selected>Ja</option>
											<option value="0">Nee</option>
										</select>
									</div>
								</div>
								<div id="smosContainer">
									<?php
									if(!empty($myOrder)) {
										$broodjesteller = 0;
										foreach ($myOrder->getBroodjes() as $broodje) {
											$broodjesteller++;
											?>
											<div class="input-group mb-3">
												<select class="custom-select" id="smos_<?php echo $broodjesteller; ?>" name="smos_<?php echo $broodjesteller; ?>">
													<option value="1" <?php if($broodje->getSmos() === 1) { echo 'selected'; } ?>>Ja</option>
													<option value="0" <?php if($broodje->getSmos() === 0) { echo 'selected'; } ?>>Nee</option>
												</select>
											</div>
											<?php
										}
									} else {
										?>
										<div class="input-group mb-3">
											<select class="custom-select" id="smos_1" name="smos_1">
												<option value="1" selected>Ja</option>
												<option value="0">Nee</option>
											</select>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-2 mb-3">
								<label for="fitness_1">Wit / Bruin</label>
								<div id="addMeFitness" style="display: none;">
									<div class="input-group mb-3">
										<select class="custom-select" id="fitness_1" name="fitness_1">
											<option value="1" selected>Wit</option>
											<option value="0">Bruin</option>
										</select>
									</div>
								</div>
								<div id="fitnessContainer">
									<?php
									if(!empty($myOrder)) {
										$broodjesteller = 0;
										foreach ($myOrder->getBroodjes() as $broodje) {
											$broodjesteller++;
											?>
											<div class="input-group mb-3">
												<select class="custom-select" id="fitness_<?php echo $broodjesteller; ?>" name="fitness_<?php echo $broodjesteller; ?>">
													<option value="1" <?php if($broodje->getFitness() === 1) { echo 'selected'; } ?>>Nee</option>
													<option value="0" <?php if($broodje->getFitness() === 0) { echo 'selected'; } ?>>Ja</option>
												</select>
											</div>
											<?php
										}
									} else {
										?>
										<div class="input-group mb-3">
											<select class="custom-select" id="fitness_1" name="fitness_1">
												<option value="1" selected>Nee</option>
												<option value="0">Ja</option>
											</select>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="type_1">Type</label>
								<div id="addMeType" style="display: none;">
									<div class="input-group mb-3">
										<select class="custom-select" id="type_1" name="type_1">


											<?php 
												// SETUP FOR PULLING ALL 'beleg' FROM DB
												foreach ($belegArr as $beleg) {
													echo '<option value="' . $beleg['id'] . '">' . $beleg['beleg'] . '</option>';
												}
	
											?>

											<?php
											/*foreach ($typeBroodjes as $broodjes) {
												echo '<option value="' . $broodjes . '">' . $broodjes . '</option>';
											}*/
											?>
										</select>
									</div>
								</div>
								<div id="typeContainer">
									<?php
									if(!empty($myOrder)) {
										$broodjesteller = 0;
										foreach ($myOrder->getBroodjes() as $broodje) {
											$broodjesteller++;
											?>
											<div class="input-group mb-3">
												<select class="custom-select" id="type_<?php echo $broodjesteller; ?>" name="type_<?php echo $broodjesteller; ?>">
													<?php

													/*while($row = $stmt->fetch()) {

														echo '<option value="'. $row['id'] . '">' . $row['beleg'] . '</option>';

													}*/	

													foreach ($belegArr as $beleg) {
														echo '<option value="' . $beleg['id'] . '">' . $beleg['beleg'] . '</option>';
													}

													/*foreach ($typeBroodjes as $broodjes) {
														echo '<option value="' . $broodjes . '"';
														if($broodje->getTypeBeleg() === $broodjes) {
															echo ' selected';
														}
														echo '>' . $broodjes . '</option>';
													}*/
													?>
												</select>
											</div>
											<?php
										}
									} else {
										?>
										<div class="input-group mb-3">
											<select class="custom-select" id="type_1" name="type_1">
												
												<?php 
													// SETUP FOR PULLING ALL 'beleg' FROM DB
													foreach ($belegArr as $beleg) {
														echo '<option value="' . $beleg['id'] . '">' . $beleg['beleg'] . '</option>';
													}
											?>


												<?php
												/*foreach ($typeBroodjes as $broodjes) {
													echo '<option value="' . $broodjes . '">' . $broodjes . '</option>';
												}*/
												?> 
											</select>
										</div>
										<?php
									}
									?>

								</div>
							</div>
						</div>
					</div>

					<button class="btn btn-default" id="addBrood">+ Voeg nog een broodje toe</button>

					<hr class="md4" />

					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="soepvdag" name="soepvdag" <?php
							if(!empty($myOrder)) {
								if($myOrder->getSoep()) {
									echo 'checked';
								}
							} ?>>
						<label class="custom-control-label" for="soepvdag">Ik wil de soep van de dag (<?php echo $soep['soep']; ?>).</label>
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

		var aantalcode = $('#addMeAantal').html().replace(/aantal_1/g, "aantal_XXX");
		var groottecode = $('#addMeGrootte').html().replace(/grootte_1/g, "grootte_XXX");
		var smoscode = $('#addMeSmos').html().replace(/smos_1/g, "smos_XXX");
		var typecode = $('#addMeType').html().replace(/type_1/g, "type_XXX");
		var fitnesscode = $('#addMeFitness').html().replace(/fitness_1/g, "fitness_XXX");

		$(function() {
			$('#addBrood').on('click', function(e) {
				e.preventDefault();
				++broodjesteller;
				$('#aantalbroodjes').val(broodjesteller);
				var myAantal = aantalcode.replace(/XXX/g, broodjesteller);
				var myGrootte = groottecode.replace(/XXX/g, broodjesteller);
				var mySmos = smoscode.replace(/XXX/g, broodjesteller);
				var myType = typecode.replace(/XXX/g, broodjesteller);
				var myFitness = fitnesscode.replace(/XXX/g, broodjesteller);
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