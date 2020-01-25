<?php

	include 'elems/init.php';
	include 'elems/sql.php';

	if($_SESSION['auth']) {
		$content = '<p class="empty_basket">Если ты зашел на эту страницу, то ты админ, а если ты админ - то сам разберешься, как тебе сделать свою табличку. Единственное, что я тебе сделаю - это сумму продаж по ДНЯМ. Итак, приступим)</p>';
		
		$content .= "
			<form action=\"\" method=\"POST\">
	<input name=\"sept\" id=\"input_sept\" placeholder=\"Введите число сентября, за которое хотите узнать продажи\">
	<input name=\"submit\" type=\"submit\" value=\"Посчитать!\">
			</form>
		";
		
		if(isset($_POST['submit']) and isset($_POST['sept'])) {
			$day = $_POST['sept'];
			$query = "SELECT orders.buy_time, goods.price, orders.quantity FROM orders 
			LEFT JOIN users ON orders.user_id = users.id 
			LEFT JOIN goods ON orders.good_id = goods.id
			WHERE orders.buy_time = '2019-09-$day'";
		
			$result = mysqli_query($link, $query);
			for($goods = []; $row = mysqli_fetch_assoc($result); $goods[] = $row);
			
			if(!empty($goods)) {
				$sum = 0;
				foreach($goods as $elem) {
					$sum += $elem['price'] * $elem['quantity'];
				}
				$date = $goods[0]['buy_time'];
				$content .= "
					<table>
						<tr>
							<th>Дата</th><th>Сумма</th>
						</tr>
						<tr>
							<td>$date</td><td>$sum</td>
						</tr>
					</table>	
				";
			} else {
				$content .= '<p class="empty_basket">Упс, ничего не нашлось(</p>';
			}
		}
	} else {
		$content = 'Вы попали на эту страницу каким-то слишком хитрым способом(';
	}

	$title = 'Корзина';	
	include 'layout.php';
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	