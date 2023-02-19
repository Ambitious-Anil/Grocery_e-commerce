<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'iiits123';
    $DATABASE_NAME = 'shoppingcart';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
// Template header, feel free to customize this
function template_header($title) {
// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		    <meta http-equiv="refresh" contents="5">
		    <meta name="viewport" content="width=device-width,intial-scale=1.0">
    			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   			    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<title>$title</title>
			<link href="style.css" rel="stylesheet" type="text/css">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header id="menu">
			   <div id="menu-bar" class="fas fa-bars"></div>
				
   				<nav class="navbar fixed-top navbar-expand-lg navbar-light ">
					<a href="#"class="logo">A<span>GRI</span>W<span>ave</span></a>
        				<a href="index.php">home</a>
					<a href="index.php?page=products">Products</a>
        			<a href="/project/home1.html">Main</a>
				<div class="icons" id="content">
        			<i class="fas fa-search fa-2xs " id="search-btn"></i>
				</div>
        		<div class="icons" id="content1">
					<i class="fas fa-user fa-2xs" id="login-btn"></i>
   		    	</div>
    
    			<form action=" " class="search-bar-container">
      			  <input type="search" id="search-bar" placeholder="search here....">
        		  <label for="search-bar" class="fas fa-search fa-2xs"></label>
    			</form>
				<div class="icons1"  >
                    <a href="index.php?page=cart" >
					<i class="fas fa-shopping-cart "></i>
					<span>$num_items_in_cart</span></a>
               	</div>
    		</nav>
	

            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Shopping Cart System</p>
            </div>
        </footer>
	<script src="script.js"></script>
    </body>
</html>
EOT;
}
?>

