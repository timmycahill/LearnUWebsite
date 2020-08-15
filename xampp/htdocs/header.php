<body>
		<header>
			<nav>
				<a href="index.php"><img id="logo" src="images/logo.png"></a>

				<div id="navLeft">
					<a class="nav-link" href="index.php">Home</a>
					<a class="nav-link" href="browse.php">Browse</a>
				</div>
				
				<div id="navRight">
					<?php
						if (isset($_SESSION['username'])) {
							echo 	'<form action="scripts/logout_script.php" method="post">
									<button type="submit" name="logout-submit">Logout</button>
									</form>
									<a class="nav-link" href="shoppingCart.php"><img id="shopping-cart-img" src="images/shoppingCart.png"></a>';
						}
						else {
							echo 	'<form name="loginform" action="scripts/login_script.php" method="post">
									<input type="text" name="emailuser" placeholder="Username/Email...">
									<input type="password" name="password" placeholder="Password...">
									<button type="submit" name="login-submit">Login</button>
									</form>
									<a class="nav-link" href="signup.php">Sign Up</a>';
						}
					?>
				</div>

			</nav>
		</header>
        
        <main>
            <article>