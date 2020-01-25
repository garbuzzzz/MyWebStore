<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<title><?= $title;?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="wrapper">
		<header class="clearfix header"><?php include 'elems/header.php';?></header>
		<aside class="clearfix"><?php include 'elems/aside.php';?></aside>
		<main>
			<?= $content?>
			<div class="clearfix"></div>
		</main>
		<footer><?php include 'elems/footer.php';?><div class="clearfix"></div></footer>
	<div>
</body>
