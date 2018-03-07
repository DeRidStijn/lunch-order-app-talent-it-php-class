<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Applicatie om broodjes te bestellen">
	<meta name="author" content="Talent IT PHP Class">

	<title>Login - Broodjes met talent</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style>

	body::after {
		content: "";
		background: url('img/login_bg.jpeg');
		background-size: cover;
		opacity: 0.2;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		position: absolute;
		z-index: -1;   
	}

	</style>
</head>

<body class="bg-light">
	<div class="container">
		<div class="py-5 text-center">
			<img class="d-block mx-auto mb-4" src="https://www.talent-it.be/wp-content/uploads/2017/08/logo-talent-it-orange-2.png" alt="" width="200" height="45">
			<h2>Broodjes met talent!</h2>
			<p class="lead">
				Gelieve je eerst aan te melden om broodjes te bestellen.
			</p>
			<form class="col-md-4 mt-4" style="margin: 0 auto;" method="POST" action="authorise.php">
				<div class="row">
					<div class="col-md-12 mb-3">
						<label for="email" class="sr-only">Email</label>
						<input type="email" class="form-control" style="padding: 10px;" id="email" placeholder="Email" required autofocus>
						<div class="invalid-feedback">
							Gelieve een geldig emailadres in te geven.
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<label for="password" class="sr-only">Paswoord</label>
						<input type="password" class="form-control" style="padding: 10px;" id="password" placeholder="Paswoord" required>
						<div class="invalid-feedback">
							Gelieve een paswoord in te vullen.
						</div>
					</div>
					<div class="col-md-12 mb-3 text-left">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
							<label class="custom-control-label" for="rememberme"> Aangemeld blijven</label>
						</div>
					</div>
					<div class="col-md-12 mb-3">
						<button type="submit" class="btn btn-dark btn-lg btn-block">Aanmelden</button>
					</div>
				</div>
			</form>
			<p class="text-muted">
				<small>Nog geen login? Vraag hem aan bij het onthaal.</small>
			</p>
		</div>
	</div>
</body>
</html>