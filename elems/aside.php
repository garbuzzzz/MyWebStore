<?php 	//эта страница на самом деле просто макет. Она подгружается на каждой странице
	$query = "SELECT name, category_id FROM subcategories";	//подкатегории
	$result = mysqli_query($link, $query);
	for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
		
	$query = "SELECT name FROM categories";		//категории
	$result = mysqli_query($link, $query);
	for($categories = []; $row = mysqli_fetch_assoc($result); $categories[] = $row);	
	
	$query = "SELECT MAX(category_id) as max FROM subcategories";	//просто находим максимальную айди из подкатегорий
	$result = mysqli_query($link, $query);
	$max_category = (mysqli_fetch_assoc($result))['max'];

	$class_li = '';

	for($i = 1; $i <= $max_category; $i++) {		//ЭТОТ ЦИКЛ СТОИЛ ТРЕХ ЧАСОВ ЖИЗНИ И СЛОМАННОЙ ГОЛОВЫ
		echo "
			<p>{$categories[$i-1]['name']}</p>
			<ul class=\"links\">
		";								// ПРИНЦИПИАЛЬНО ТО, ЧТО ВМЕСТО ФОРЫЧА ИСПОЛЬЗУЕТСЯ ПРОСТО ВЫВОД НА ЭКРАН МАССИВА С ИЗМЕНЯЮЩИМСЯ КЛЮЧОМ, КЛЮЧ ИЗМЕНЯЕТСЯ ИФОМ. 
		foreach ($categories as $category) {
			foreach ($data as $subcategory) {	
				if($subcategory['category_id'] == $i) {
					if($_GET['subcategory'] == $subcategory['name']) {	
						$class_li = 'active';
					}
					echo "
						<li><a href=\"subcategory.php?subcategory={$subcategory['name']}\" class=\"$class_li\">{$subcategory['name']}</a></li>
						<div class=\"clearfix\"></div>
					";
					$class_li = '';
				}	
			}	
			break;
		}
		echo '</ul>';
	}
?>






