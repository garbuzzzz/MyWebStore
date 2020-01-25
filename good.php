<?php
	include 'elems/init.php';
	include 'elems/sql.php';
	
	if(!empty($_GET['good'])) {
		$good_name = $_GET['good'];
		
		$query = "SELECT * FROM goods WHERE name = '$good_name'";	
		$result = mysqli_query($link, $query);
		$good = mysqli_fetch_assoc($result);
		
		$content = "
			
			<div class=\"good\">
							<img src=\"img/{$good['imagine']}\">
							<p>{$good['name']}</p>
							<p>Цена: {$good['price']}р</p>
							<p>Описание: {$good['product description']}</p>
			";
			
		if($_SESSION['auth']) {
			$content .= "
				<p><a href=\"?good={$_GET['good']}&add={$good['name']}\">Добавить в корзину</a></p>
			";
		} else {
			$content .= "
				<p>Для того, чтобы добавить в корзину, сначала <a href=\"login.php\">авторизируйтесь </a> или вообще зарегистрируйтесь</p>
			";
		}
	}
	
	if(!empty($_GET['add'])) {
		$add = $_GET['add'];
		
		$user_id = $_SESSION['user_id'];
		$good_id = $good['id']; 
		$query = "SELECT * FROM basket WHERE user_id = '$user_id' and good_id = '$good_id'";	
		$result = mysqli_query($link, $query);
		$replay = mysqli_fetch_assoc($result);
		
		
		if(empty($replay)) {
			$query = "INSERT INTO basket SET user_id = '$user_id', good_id = '$good_id'";	
			mysqli_query($link, $query);
			$content = "<p class=\"message_auth\">Товар успешно добавлен в корзину. <a href=\"basket.php?id=$user_id\">Перейти в корзину</a></p>".$content;
		} else {
			$new_quantity = $replay['quantity'] + 1;
			$query = "UPDATE basket SET quantity = '$new_quantity' WHERE user_id = '$user_id' and good_id = '$good_id'"; 
			mysqli_query($link, $query);
			$content = "<p class=\"message_auth\">Товар успешно добавлен в корзину. <a href=\"basket.php?id=$user_id\">Перейти в корзину</a></p>".$content;
		}

	}	
	
	$title = $good['name'];	
	include 'layout.php';


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	