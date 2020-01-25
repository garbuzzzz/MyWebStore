<?	
	include 'elems/init.php';
	include 'elems/sql.php';
	
	if(!empty($_GET['id'])) {	//то есть если мы вообще пришли на эту страницу по ссылке из товаров
		$id = $_GET['id'];	//DISTINCT если что это удаление дублей!!
		$query = "SELECT DISTINCT(goods.name), goods.imagine, goods.price, basket.quantity, basket.good_id FROM basket 
		LEFT JOIN users ON basket.user_id = users.id 
		LEFT JOIN goods ON basket.good_id = goods.id
		WHERE user_id = '$id' and basket.quantity > 0";
		$result = mysqli_query($link, $query);
		for($goods = []; $row = mysqli_fetch_assoc($result); $goods[] = $row);	//тут получаются все товары, которые купил человек с данным id, причем только те, количество которых в базе больше 0. Это нужно для того случая, когда мы будем кнопками уменьшать количество для нуля, чтобы нулевые товары не выводились. 
		
		if(!empty($goods)) {
		//составляем таблицу
			$content = '<p>Список ваших товаров:</p>';
			$content .= '
				<table>
				<tr>
					<th>Название товара</th><th>Фото</th><th>Цена</th><th>Количество</th><th>Изменить количество</th><th>Удалить из корзины</th><th>ИТОГО:</th>
				</tr>
			'; 
			foreach ($goods as $elem) {	//выводим на экран данные
				$sum = ($elem['price'] * $elem['quantity']).'р';	//используем именно POST, потому что мы уже находимся на странице с гет-параметром, и если будем использовать массив ГЕТ, то он затрется атрибутом Эктион, и мы не попадем в первый ИФ. Если же мы используем ПОСТ, то мы переадресовываемся как бы на эту же страницу, с имеющимся ГЕТ параметром. 
				$content .= "
					<tr>
				<td class=\"td_name\">{$elem['name']}</td>		
				<td><img src=\"img/{$elem['imagine']}\"></td>		
				<td>{$elem['price']}р</td>
				<td>{$elem['quantity']}</td>
				<td>
					<form action=\"\" method=\"POST\">
				<input type=\"submit\" name=\"plus{$elem['good_id']}\" value=\"+1\">
						<input type=\"submit\" name=\"minus{$elem['good_id']}\" value=\"-1\">
					</form>
				</td>
				<td>
					<form action=\"\" method=\"POST\">
						<input type=\"submit\" name=\"del{$elem['good_id']}\" value=\"Удалить\">
					</form>
				</td>
				<td>$sum</td>
			</tr>
				";
			
					
				if(!empty($_POST["plus{$elem['good_id']}"])) {
					$good_id = $elem['good_id'];
					$query = "SELECT quantity FROM basket WHERE user_id = '$id' and good_id = '$good_id'";
					$result = mysqli_query($link, $query);
					$new_quantity = mysqli_fetch_assoc($result)['quantity'] + 1;
					
					$query = "UPDATE basket SET quantity = '$new_quantity' WHERE user_id = '$id' and good_id = '$good_id'";
					mysqli_query($link, $query);
					header("Location: basket.php?id=$id");

				}
				if(!empty($_POST["minus{$elem['good_id']}"])) {
					$good_id = $elem['good_id'];
					$query = "SELECT quantity FROM basket WHERE user_id = '$id' and good_id = '$good_id'";
					$result = mysqli_query($link, $query);
					$new_quantity = mysqli_fetch_assoc($result)['quantity'] - 1;
					
					$query = "UPDATE basket SET quantity = '$new_quantity' WHERE user_id = '$id' and good_id = '$good_id'";
					mysqli_query($link, $query);
					header("Location: basket.php?id=$id");
				}
					
				if(!empty($_POST["del{$elem['good_id']}"])) {
					$good_id = $elem['good_id'];
					$query = "DELETE FROM basket WHERE user_id = '$id' and good_id = '$good_id'";
					$result = mysqli_query($link, $query);
					header("Location: basket.php?id=$id");
				}
			}	

			$main_sum = 0;
			foreach ($goods as $elem) {
				$main_sum += $elem['quantity'] * $elem['price'];
			}
			$main_sum .= 'р';
			$content .= "
				<tr>
					<td>Итого к оплате</td><td></td><td></td><td></td><td></td>
					<td>
					<form action=\"\" method=\"POST\">
						<input id=\"check\" type=\"submit\" name=\"order\" value=\"Заказать\">						
					</form>
					</td>
					<td>$main_sum</td>
				</tr>
				</table>
			";
			
			if(!empty($_POST["order"])) {
				foreach ($goods as $elem) {
					$sum = ($elem['price'] * $elem['quantity']).'р';
					$good_id = $elem['good_id'];
					$quantity = $elem['quantity'];
					$buy_time = date('Y-m-d');
					$query = "INSERT INTO orders SET user_id = '$id', good_id = '$good_id', quantity = '$quantity', buy_time = '$buy_time'";
					mysqli_query($link, $query);
				}
				$query = "DELETE FROM basket WHERE user_id = '$id'";
				mysqli_query($link, $query);
				$content = '<p class="empty_basket">Наш модератор свяжется с вами в ближайшее время</p>';
			}	
	
		} else {
			$content = '<p class="empty_basket">Ваша корзина пуста, прикупите шлака всяка)</p>';
		}
	}
	
	$title = 'Корзина';	
	include 'layout.php';


	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	





















