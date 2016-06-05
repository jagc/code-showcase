<!DOCTYPE html>
<html lang="en">
<!-- head here -->
<?Flight::render('head.view.php')?>
	<body class="nopadding ">
		<!-- header-bar here -->
		<?php
	    if($render_header_bar_content === true)
	      Flight::render('header-bar.view.php')
		?>
	  <div class="container">
	    <!-- form here -->
			<?Flight::render('form.view.php')?>
	    <!-- results here -->
			<?Flight::render('results.view.php')?>
	  </div>
		<?Flight::render('scripts.view.php')?>
	</body>
</html>
