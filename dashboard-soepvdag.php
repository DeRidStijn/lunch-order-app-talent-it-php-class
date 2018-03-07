<?php

$qrySoep = $pdo->prepare('SELECT * FROM `soep`');
$qrySoep->execute();

$soepArray = [];

while($row = $qrySoep->fetch()) {
	$soepArray[] = $row['soep'];
}

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h1 class="h2">Soep van de dag</h1>
</div>
<p>
	Via onderstaand formulier kan je de weekmenu van de soep van de dag doorgeven.
</p>
<form method="POST" action="savesoep.php">
	<div class="row">
		<div class="col-md-12 order-md-2 mb-4">
			<h4 class="mb-3">Weekmenu</h4>

			<div class="row">
				<div class="col-md-4 mb-3">
					<label for="soep1">Maandag</label>
					<input type="text" class="form-control" id="soep1" name="soep1" placeholder="Tomatensoep" value="<?php echo $soepArray[0]; ?>" required>
					<div class="invalid-feedback">
						Gelieve een soep in te vullen
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="soep2">Dinsdag</label>
					<input type="text" class="form-control" id="soep2" name="soep2" placeholder="Tomatensoep" value="<?php echo $soepArray[1]; ?>" required>
					<div class="invalid-feedback">
						Gelieve een soep in te vullen
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="soep3">Woensdag</label>
					<input type="text" class="form-control" id="soep3" name="soep3" placeholder="Tomatensoep" value="<?php echo $soepArray[2]; ?>" required>
					<div class="invalid-feedback">
						Gelieve een soep in te vullen
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 mb-3">
					<label for="soep4">Donderdag</label>
					<input type="text" class="form-control" id="soep4" name="soep4" placeholder="Tomatensoep" value="<?php echo $soepArray[3]; ?>" required>
					<div class="invalid-feedback">
						Gelieve een soep in te vullen
					</div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="soep5">Vrijdag</label>
					<input type="text" class="form-control" id="soep5" name="soep5" placeholder="Tomatensoep" value="<?php echo $soepArray[4]; ?>" required>
					<div class="invalid-feedback">
						Gelieve een soep in te vullen
					</div>
				</div>
			</div>

			<hr class="md4" />

			<button class="btn btn-dark btn-sm btn-block" type="submit">Bewaar soepjes</button>
		</div>
	</div>
</form>