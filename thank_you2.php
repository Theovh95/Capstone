<!DOCTYPE html>
<html lang = "en-US">
	<head>
		<meta charset="utf-8">
		<meta name="desription" content="mattsarg, a website that aims to give pointers about
			how to use HTML5 to develope web pages.">
		<title>mattsarg Website Developer Webpage Creation Resource</title>
		<link href="stylesheets/final6.css" rel="stylesheet">
		<link rel="icon" href="images/favicon52.ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<section id="wrapper">
			<main>

<?php
  include 'core/init.php';

  include 'header.php';
  if(loggedin()) {
    include 'nav_top.php';
    include 'float_nav.php';
  } else {
    include 'nav_top_logged_out.php';
    include 'float_nav_logged_out.php';
  }
?>   
        <section>
          <h2>Thank you for creating an account</h2>
        </section>
			</main>
			<footer>
<?php 

          if (loggedin()) {
            include 'footer_nav.php';
          }else {
            include 'footer_nav_logged_out.php';
          }

          include 'footer.php';
?>
      </footer>
      <?php
        include 'include_scripts.php';
      ?>
		</section>
	</body>
</html>
