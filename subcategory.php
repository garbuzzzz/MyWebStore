<?php
	include 'elems/init.php';
	include 'elems/sql.php';
	
	if(!empty($_GET['subcategory'])) {
		$subcategory = $_GET['subcategory'];
	}
	
	
	$query = "SELECT * FROM subcategories WHERE name = '$subcategory'";	//подкатегории
	$result = mysqli_query($link, $query);
	$subcategory = mysqli_fetch_assoc($result);
	$subcategory_id = $subcategory['id'];
	
	$query = "SELECT * FROM goods WHERE subcategory_id = '$subcategory_id'";	//подкатегории
	$result = mysqli_query($link, $query);
	for($goods = []; $row = mysqli_fetch_assoc($result); $goods[] = $row);	
	
	$content = "
	<div id=\"subcategory\">
	<ul>
	";
	
	foreach ($goods as $elem) {
		$content .= "
			<li>
				<div class=\"div_image\">
					<a href=\"good.php?good={$elem['name']}\"><img src=\"img/{$elem['imagine']}\"></a>
					<a href=\"good.php?good={$elem['name']}\"><p>{$elem['name']}</p></a>
					<p>Цена: {$elem['price']}р</p>
				</div>
			</li>
		";
	}
	
	$content .= '
		</ul>
		</div>
	
	';
	


	$title = $subcategory['name'];	
	include 'layout.php';

















