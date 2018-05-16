<?php
  include 'core/init.php';
  include 'core/other_init.php';
$ip_address = $_SERVER['REMOTE_ADDR'];

if(loggedin()){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = $ip_address;
}
?>

<!DOCTYPE html>
<html lang = "en-US">
	<head>
		<meta charset="utf-8">
		<meta name="desription" content="mattsarg, a website that allows you to post videos to a more local audience">
		<title>About</title>
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
				<h2>What this website aims to do</h2>
				<section>
					<p class="about_text">
							This website aims to give anybody who has some time to waste to waste it playing our game.
					</p>
				</section>
				<br>
				<h2>How to get started</h2>
				<section>
					<p class="about_text">
				    Simply login with your google account or make an account with the website or even just play as a guest.
					</p>
				</section>
				<br>
				<h2>Who is this for?</h2>
				<section>
					<p class="about_text">
						For anyone who has some time to spend playing a game.
					</p>
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
