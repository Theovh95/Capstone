<?php
include 'core/other_init.php';
include 'core/init.php';

$ip_address = $_SERVER['REMOTE_ADDR'];

if(loggedin() || $auth->isLoggedIn()){
  $user_id = $_SESSION['user_id'];
  
}else{
  $user_id = $ip_address;
}

?>


<!DOCTYPE html>
<html lang = "en-US">
	<head>
		<meta charset="utf-8">
		<meta name="desription" content="a website that allows people to play a game.">
		<title>CoolName Game Page</title>
		<link href="stylesheets/final6.css" rel="stylesheet">
		<link rel="icon" href="images/favicon(1).ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  <script src="js/phaser.min.js"></script>
    <script src="js/game.js"></script>  
	</head>
	<body>
		<section id="wrapper">
			<main>

<?php
  include 'header.php';
  include 'top_meta_nav.php';
?>        

				<h2>Game</h2>
        <h3>Welcome to CoolName Game.</h3>
				<section id="game_container">

          <div id="game" class='game' width="900px" height="600px"></div>

        </section>
			</main>
			<footer>
        <?php
          include 'footer_meta_nav.php';
          include 'footer.php';  
        ?>
			</footer>    
    <?php
include 'include_scripts.php';
    ?>
		</section>
	</body>
</html>
