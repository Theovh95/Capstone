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
		<link href="stylesheets/final5.css" rel="stylesheet">
		<link rel="icon" href="images/favicon(1).ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<section id="wrapper">
			<main>

<?php 

        include 'header.php';


        if(loggedin()) {
          include 'nav_top.php';
        } else {
          include 'nav_top_logged_out.php';
        }
      
?>
				<h2>What this website aims to do</h2>
				<section>
					<ul id="newUL">
						<li>
              Text here.
            </li>
					</ul>
				</section>
				<h2>How to get started</h2>
				<section>
					<p>
						Text here.
					</p>
				</section>
				<h2>Who is this for?</h2>
				<section>
					<p>
						Text here
					</p>
				</section>
			</main>
			<footer>

<?php 

          include 'footer_meta_nav.php';

          include 'footer.php';
          
?>

			</footer>
		</section>
    <?php
      include 'include_scripts.php';
    ?>
  </body>
</html>
