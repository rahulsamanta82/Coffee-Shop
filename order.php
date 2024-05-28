<?php 
	session_start();

	// Check if user is not logged in and redirect to login page
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit;
    }
	
	// Logout logic
    if (isset($_GET['logout'])) {
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: index.php"); // Redirect to the home page after logout
        exit;
    }
?>
<!DOCTYPE html>
<html>
	<head lang="en">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Order List</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/order.js"></script>		 
	</head>
	<body>
		<div id="body">
			<div id="header">
				<a><img id="mainlogo" src="img/mainlogo.png" alt="Fourth Coffee Logo"/></a>
				<h1 id="title">Fourth Coffee</h1>
				<p id="tagline">Bringing the world to your cup</p>
				<ul id="navlinks">
					<li><a href="index.php">Home</a></li>
					<li><a href="products.php">Products</a></li>
					<li><a href="support.php">Support</a></li>
					<li><a class="current" href="order.php">Order List</a></li>
					<li><a href="about.php">About Us</a></li>
					<?php if (isset($_SESSION['username'])): ?>
                    <li><a href="#"><?= htmlspecialchars($_SESSION['username']) ?></a></li>
					<li><a href="?logout=1">Logout</a></li> <!-- Logout link -->
                    <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                    <li class="last"><a href="signup.php">Sign up</a></li>
                    <?php endif; ?>
				</ul>
			</div>
			<div id="order">
				<div id="last_order">
					<h2>Your Last Order</h2>
					<?php 	
						if (filesize("order.txt") == 0)
							echo "You have not made a single order";
						else {
							$file = fopen("order.txt", "r");
							$order;
							while(!feof($file)) {
								$line = fgets($file);
								if ($line == "")
									break;
								$order = $line;											
							}				
							$order = explode(",", $order);	
							echo "<p>Product name: ".$order[0]."</p>";
							echo "<p>Quantity: ".$order[1]."</p>";
							echo "<p>Username: ".$order[2]."</p>";
							echo "<p>User address: ".$order[3]."</p>";
							fclose($file);	
						}			
					 ?>	
				</div>				
				<div id="order_list">
					<h2>Your All Order List</h2>
					<?php 	
						if (filesize("order.txt") == 0)
							echo "You have not made a single order";
						else {
							$file = fopen("order.txt", "r");
							$order;
							$count = 1;
							while(!feof($file)) {
								$order = fgets($file);
								if ($order == "")
									break;
								$order = explode(",", $order);
								echo "<p class=\"count\">Order ".$count."</p>";
								echo "<p>Product name: ".$order[0]."</p>";
								echo "<p>Quantity: ".$order[1]."</p>";
								echo "<p>Username: ".$order[2]."</p>";
								echo "<p>User address: ".$order[3]."</p>";
								echo "<hr>";	
								$count++;
							}						
							fclose($file);	
						}			
					 ?>	
				</div>
				<button onclick="showAll()">Show All Order List</button>	
			</div>
			<div id="footer">
				<p>Contact: 213-333-3333</p>
		    	</div>
		</div>	
	</body>
</html>