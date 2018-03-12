<?php

require_once('Brood.php');
require_once('Order.php');
require_once __DIR__ . '/config.php';

session_start();
session_destroy();
session_start();

// SETUP FOR PULLING ALL 'beleg' FROM DB

$pdo = new PDO($config['dsn'], $config['username'], $config['password'], $config['options']);

$stmt = $pdo->prepare('SELECT soep FROM soep WHERE id=' . date('N'));
$stmt->execute();

$soep = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM beleg');
$stmt->execute();

$belegArr = $stmt->fetchAll();

$categorieStmt = $pdo->prepare('SELECT * FROM categorie');
$categorieStmt->execute();

$categorieArr = $categorieStmt->fetchAll();

if(!empty($_SESSION['order'])) {
	$myOrder = $_SESSION['order'];
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Applicatie om broodjes te bestellen">
	<meta name="author" content="Talent IT PHP Class">

	<title>Broodjes met talent!</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="bg-light">
	<!-- Test area -->
	<?php

	/*foreach ($categorieArr as $categorie) {
		echo $categorie['categorie'];
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
		<div id="copyMe" style="display: none;">
			<div class="row">
				<div class="col-md-2 mb-3">
					<input type="number" name="aantal_XXX" class="form-control mb-3" id="aantal_XXX" placeholder="1" value="1" required="">
				</div>
				<div class="col-md-2 mb-3">
					<div class="input-group mb-3">
						<select class="custom-select" id="grootte_XXX" name="grootte_XXX">
							<option value="1" selected>Groot</option>
							<option value="0">Klein</option>
						</select>
					</div>
				</div>
				<div class="col-md-2 mb-3">
					<div class="input-group mb-3">
						<select class="custom-select" id="smos_XXX" name="smos_XXX">
							<option value="1" selected>Ja</option>
							<option value="0">Nee</option>
						</select>
					</div>
				</div>
				<div class="col-md-2 mb-3">
					<div class="input-group mb-3">
						<select class="custom-select" id="fitness_XXX" name="fitness_XXX">
							<option value="1" selected>Wit</option>
							<option value="0">Bruin</option>
						</select>
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<select class="custom-select" id="type_XXX" name="type_XXX">
						<?php 
							// SETUP FOR PULLING ALL 'beleg' FROM DB
							foreach($categorieArr as $categorie) {
								echo '<optgroup label="' . $categorie['categorie'] . '">'; 
									foreach ($belegArr as $beleg) {
										if($beleg['categorie_id'] === $categorie['id']) {
											echo '<option value="' . $beleg['id'] . '">' . $beleg['naam'] . '</option>';	
										}
									}
								echo '</optgroup>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="opmerking_XXX" class="col-sm-2 col-form-label">Opmerking</label>
				<div class="col-sm-6 mb-3">
					<textarea class="form-control" id="opmerking_XXX" name="opmerking_XXX" rows="2"></textarea>
				</div>
				<div class="col-sm-4 mb-3">
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="brood_XXX_supplement_1" name="brood_XXX_supplement_1">
						<label class="custom-control-label" for="brood_XXX_supplement_1">Supplement pikante saus.</label>
					</div>
					<div class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" id="brood_XXX_supplement_2" name="brood_XXX_supplement_2">
						<label class="custom-control-label" for="brood_XXX_supplement_2">Supplement tabasco.</label>
					</div>
				</div>
			</div>
			<hr class="md4" />
		</div>
		<form method="POST" action="broodje_verwerken.php">
			<input type="number" value="1" id="aantalbroodjes" name="aantalbroodjes" style="display: none;" />
			<div class="row">
				<div class="col-md-12 order-md-1">
					<h4 class="mb-3">Kies je broodjes</h4>
					<div class="titles">
						<div class="row">
							<div class="col-md-2">
								<label for="aantal_1">Aantal</label>
							</div>
							<div class="col-md-2">
								<label for="grootte_1">Grootte</label>
							</div>
							<div class="col-md-2">
								<label for="smos_1">Smos</label>
							</div>
							<div class="col-md-2">
								<label for="fitness_1">Wit / Bruin</label>
							</div>
							<div class="col-md-4">
								<label for="type_1">Type</label>
							</div>
						</div>
					</div>
					<div id="vulBroodjes">
						<?php

						if (!empty($myOrder)) {
							$broodjesteller = 0;
							foreach ($myOrder->getBroodjes() as $broodje) {
								$broodjesteller++;
								?>
								<div class="row">
									<div class="col-md-2 mb-3">
										<input type="number" name="aantal_<?php echo $broodjesteller; ?>" class="form-control mb-3" id="aantal_<?php echo $broodjesteller; ?>" placeholder="1" value="1" required="">
									</div>
									<div class="col-md-2 mb-3">
										<div class="input-group mb-3">
											<select class="custom-select" id="grootte_<?php echo $broodjesteller; ?>" name="grootte_<?php echo $broodjesteller; ?>">
												<option value="1" <?php if($broodje->getBaguette() === 1) { echo 'selected'; } ?>>Groot</option>
												<option value="0" <?php if($broodje->getBaguette() === 0) { echo 'selected'; } ?>>Klein</option>
											</select>
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<div class="input-group mb-3">
											<select class="custom-select" id="smos_<?php echo $broodjesteller; ?>" name="smos_<?php echo $broodjesteller; ?>">
												<option value="1" <?php if($broodje->getSmos() === 1) { echo 'selected'; } ?>>Ja</option>
												<option value="0" <?php if($broodje->getSmos() === 0) { echo 'selected'; } ?>>Nee</option>
											</select>
										</div>
									</div>
									<div class="col-md-2 mb-3">
										<div class="input-group mb-3">
											<select class="custom-select" id="fitness_<?php echo $broodjesteller; ?>" name="fitness_<?php echo $broodjesteller; ?>">
												<option value="1" <?php if($broodje->getFitness() === 1) { echo 'selected'; } ?>>Wit</option>
												<option value="0" <?php if($broodje->getFitness() === 0) { echo 'selected'; } ?>>Bruin</option>
											</select>
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<select class="custom-select" id="type_<?php echo $broodjesteller; ?>" name="type_<?php echo $broodjesteller; ?>">
											<?php 
												// SETUP FOR PULLING ALL 'beleg' FROM DB
												foreach($categorieArr as $categorie) {
													echo '<optgroup label="' . $categorie['categorie'] . '">'; 
														foreach ($belegArr as $beleg) {
															if($beleg['categorie_id'] === $categorie['id']) {
																echo '<option value="' . $beleg['id'] . '" ';
																if($broodje->getTypeBeleg() === $beleg['id']) { echo 'selected'; }
																echo '>' . $beleg['naam'] . '</option>';	
															}
														}
													echo '</optgroup>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="opmerking_1" class="col-sm-2 col-form-label">Opmerking</label>
									<div class="col-sm-6 mb-3">
										<textarea class="form-control" id="opmerking_<?php echo $broodjesteller; ?>" name="opmerking_<?php echo $broodjesteller; ?>" rows="2"></textarea>
									</div>
									<div class="col-sm-4 mb-3">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="brood_<?php echo $broodjesteller; ?>_supplement_1" name="brood_<?php echo $broodjesteller; ?>_supplement_1">
											<label class="custom-control-label" for="brood_<?php echo $broodjesteller; ?>_supplement_1">Supplement pikante saus.</label>
										</div>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="brood_<?php echo $broodjesteller; ?>_supplement_2" name="brood_<?php echo $broodjesteller; ?>_supplement_2">
											<label class="custom-control-label" for="brood_<?php echo $broodjesteller; ?>_supplement_2">Supplement tabasco.</label>
										</div>
									</div>
								</div>
								<hr class="md4" />
								<?php
							}
						}

						?>
					</div>
					
					<input type="button" class="btn btn-default" id="addBrood" value="+ Voeg nog een broodje toe" />

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
		
		var broodjesteller = 0;

		var toCopy = $('#copyMe').html();

		$(function() {
			$('#addBrood').on('click', function(e) {
				e.preventDefault();
				++broodjesteller;
				$('#aantalbroodjes').val(broodjesteller);
				var myCopy = toCopy.replace(/XXX/g, broodjesteller);
				$('#vulBroodjes').append(myCopy);
			});

			<?php

			if(empty($myOrder)) {
				?>
				$('#addBrood').trigger( "click" );
				<?php
			}

			?>
		});

	</script>
</body>
</html>