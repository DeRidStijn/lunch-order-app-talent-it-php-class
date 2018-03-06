<nav class="col-md-2 d-none d-md-block bg-light sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link <?php if(!isset($_GET['page'])) { echo 'active'; } ?>" href="dashboard.php">
					<span data-feather="home"></span>
					Home
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'soepvdag') { echo 'active'; } ?>" href="dashboard.php?page=soepvdag">
					<span data-feather="heart"></span>
					Soep v/d dag
				</a>
			</li>
			<li class="nav-item">
				<hr />
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'orders') { echo 'active'; } ?>" href="dashboard.php?page=orders">
					<span data-feather="shopping-cart"></span>
					Bestellingen
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'geldpotje') { echo 'active'; } ?>" href="dashboard.php?page=geldpotje">
					<span data-feather="dollar-sign"></span>
					Geldpotje
				</a>
			</li>
			<li class="nav-item">
				<hr />
			</li>
		</ul>

		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
			<span>Gebruikers</span>
			<a class="d-flex align-items-center text-muted" href="#">
				<span data-feather="plus-circle"></span>
			</a>
		</h6>
		<ul class="nav flex-column mb-2">
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					TBA
				</a>
			</li>
		</ul>
	</div>
</nav>