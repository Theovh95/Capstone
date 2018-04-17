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
		<title>CoolName Home Page</title>
		<link href="stylesheets/final6.css" rel="stylesheet">
		<link rel="icon" href="images/favicon(1).ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">

	</head>
	<body>
		<section id="wrapper">
			<main>

<?php
  include 'header.php';
  include 'top_meta_nav.php';
?>        

				<h2>Home</h2>

<?php if (!loggedin()): ?>
          <a href="game.php"><img src="play_as_guest.png" alt="Play as Guest" height="100px" width="150px"></a><br>
          <a href="login.php"><img src="log_in.png" alt="Login" height="100px" width="150px"></a>
					<h3>Welcome to CoolName Game.</h3>

<?php else: ?>
          <a href="game.php"><img src="play.png" alt="Play Game" height="100px" width="150px"></a>
					<h3>Hello, <?= $_SESSION['email'] ?> welcome to CoolName Game.</h3>
<?php endif;?>
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
