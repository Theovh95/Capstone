<!DOCTYPE html>
<html lang = "en-US">
	<head>
		<meta charset="utf-8">
		<meta name="desription" content="mattsarg, a website that aims to give pointers about
			how to use HTML5 to develope web pages.">
		<title>mattsarg Website Developer Webpage Creation Resource</title>
		<link href="stylesheets/final5.css" rel="stylesheet">
		<link rel="icon" href="images/favicon(1).ico" type=image/x-icon>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<section id="wrapper">
			<main>
<?php
  include 'core/init.php';
  include 'core/other_init.php';
  include 'header.php';
  if(loggedin()) {
    include 'nav_top.php';
  } else {
    include 'nav_top_logged_out.php';
  }
?>   
				<h2>Create an account</h2>
				<section>
<?php
  echo '<a href="'.$auth->getAuthUrl().'"><img src="images/google_signin.png"></a><br><br>';
?>
 				<fieldset>
				<legend>Create An Account</legend>
					<form action="log_in_form2.inc.php" method="post">
						* E-mail: <input type="email" name="email" maxlength="40" id="email" required="required" placeholder="person@example.com"><br><br>
						* Password: <input type="password" name="password" id="password" required="required"><br>
						* Retype Password: <input type="password" name="password_again" id="password_again" required="required"><br>
						<br><input type="submit" value="Create Account">
					</form>
				</fieldset>
          <p>Already have an account?</p>
					<h3><a href = "login.php">Login</a></h3>
				</section>
			</main>
			<footer>
				<section class="footerNav">

<?php 

          if (loggedin()) {
            include 'footer_nav.php';
          }else {
            include 'footer_nav_logged_out.php';
          }

          include 'footer.php';
?>
        </footer>
		</section>
    <?php
      include 'include_scripts.php';
    ?>    
	</body>
</html>
