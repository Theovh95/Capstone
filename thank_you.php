<?php
include 'vendor/autoload.php';
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
		<meta name="desription" content="mattsarg, a website that aims to give pointers about
			how to use HTML5 to develope web pages.">
		<title>mattsarg Website Developer Webpage Creation Resource</title>
		<link href="stylesheets/final5.css" rel="stylesheet">
		<link rel="icon" href="images/favicon52.ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<section id="wrapper">
			<main>
<?php
  include 'header.php';
  include 'top_meta_nav.php';

?>   
        <section>
				<h2>Your Video has been Uploaded</h2>

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
