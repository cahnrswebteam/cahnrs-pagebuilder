<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		the_content();
	} // end while
} // end if
?>
</body>
</html>