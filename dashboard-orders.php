<?php

/*

SELECT o.id, o.user_id, o.soep, o.soepbrood_wit, ob.aantal, b.beleg_id, b.is_wit, b.is_groot, b.opmerking
FROM broodjesapp.order AS o
LEFT JOIN broodjesapp.order_broodje AS ob ON ob.order_id = o.id
LEFT JOIN broodjesapp.broodje AS b ON b.id = ob.broodje_id
WHERE o.user_id = 1 AND DATE(o.datum) = DATE(NOW())
ORDER BY o.id ASC;

*/

$qryOrder = $pdo->prepare('SELECT o.id,
								  u.naam,
								  u.voornaam,
								  o.soep,
								  o.soepbrood_wit
						   FROM `order` AS o
						   LEFT JOIN `user` AS u ON u.id = o.user_id
						   WHERE DATE(o.datum) = DATE(NOW())
						   ORDER BY o.id ASC');

$qryOrder->execute();
$orderArray = $qryOrder->fetchAll();

foreach ($orderArray as $index => $order) {
	$qryBroodjes = $pdo->prepare('SELECT ob.aantal, 
										 b.beleg_id, 
										 b.is_wit, 
										 b.is_groot, 
										 b.opmerking
								  FROM `order_broodje` AS ob
								  LEFT JOIN `broodje` AS b ON b.id = ob.broodje_id
								  WHERE ob.order_id = ?
								  ORDER BY ob.broodje_id ASC');

	$qryBroodjes->bindValue(1, $order['id'], PDO::PARAM_INT);
	$qryBroodjes->execute();
	$broodjesArray = $qryBroodjes->fetchAll();

	$orderArray[$index]['broodjes'] = $broodjesArray;
}

?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
	<h1 class="h2">Bestellingen van vandaag (<?php echo date('d-m-Y'); ?>)</h1>
</div>
<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>Gebruiker</th>
				<th>Soep</th>
				<th>Soepbrood</th>
				<th>Broodjes</th>
				<th>Prijs</th>
			</tr>
		</thead>
		<tbody>
			<?php

			foreach ($orderArray as $order) {
				echo '<tr><td>' . $order['naam'] . '&nbsp;' . $order['voornaam'] . '</td>';
				if($order['soep']) {
					echo '<td data-value="1">Ja</td>';
				} else {
					echo '<td data-value="0">Nee</td>';
				}
				if($order['soepbrood_wit']) {
					echo '<td data-value="1">Wit</td>';
				} else {
					echo '<td data-value="0">Bruin</td>';
				}
				echo '<td>';
				foreach ($order['broodjes'] as $broodje) {
					/*
					
					array(10) { ["aantal"]=> string(1) "5" [0]=> string(1) "5" ["beleg_id"]=> string(1) "5" [1]=> string(1) "5" ["is_wit"]=> string(1) "0" [2]=> string(1) "0" ["is_groot"]=> string(1) "1" [3]=> string(1) "1" ["opmerking"]=> string(16) "Zonder komkommer" [4]=> string(16) "Zonder komkommer" }

					*/
					echo '<strong>' . $broodje['aantal'] . '</strong> x ';
					if($broodje['is_groot']) {
						echo 'groot ';
					} else {
						echo 'klein ';
					}
					if($broodje['is_wit']) {
						echo 'wit ';
					} else {
						echo 'bruin ';
					}
					echo '&nbsp;<em>(Opmerking: ' . $broodje['opmerking'] . ')</em> - &euro; 3.50<br />';
				}
				echo '</td><td>TOTAALPRIJS</td></tr>';
			}

			?>
		</tbody>
	</table>
</div>