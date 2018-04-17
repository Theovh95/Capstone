<!DOCTYPE html>

<html lang = "en-US">
	<head>
		<meta charset="utf-8">
		<meta name="desription" content="mattsarg, a website that aims to give pointers about
			how to use HTML5 to develope web pages.">
		<title>mattsarg Website Developer Webpage Creation Resource</title>
		<link href="stylesheets/final6.css" rel="stylesheet">
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

				<h2>Login</h2>
				<section>

        <fieldset>
				<br><br>
				<legend>Sign in</legend>

<?php
  echo '<a href="'.$auth->getAuthUrl().'"><img src="images/google_signin.png"></a><br><br>';
?>        
        
        <form action="log_in_script.php" method="post">

          Email: <input type="email" placeholder="sophie@example.com" name="email" required="required">
          Password: <input type="password" name="password" required="required">
                    <input type="submit" value="Log In">
        </form>


				</fieldset><br><br>
					<p>Don't already have an account?</p>
          <h3><a href ="create_account.php">Create&nbsp;Account</a></h3>
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






