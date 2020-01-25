<?php
	include 'elems/init.php';
	include 'elems/sql.php';
	
	$form = "
		<form action=\"\" method=\"POST\" class=\"reg\">
			<p>Введите свой логин</p>
			<input name=\"login\"><br><br>
			<p>Введите свой пароль</p>
			<input type=\"password\" name=\"password\"><br><br>
			<input type=\"submit\" name=\"submit\" value=\"Авторизироваться\">
		</form>
	";
	
	$content = '
		<p class="paragraph">Здесь вы увидите наикрасивейшее окно регистрации:</p>
	';
	$content .= $form;
	
	if(!empty($_POST['login'])){
		$login = $_POST['login'];
		$query = "SELECT * FROM users WHERE login='$login'";
		$result = mysqli_query($link, $query) or die(mysqli_error($link));
		$user = mysqli_fetch_assoc($result);

		if(!empty($user)) {
			if(password_verify($_POST['password'], $user['password'])) {
				$_SESSION['auth'] = true;
				$_SESSION['id'] = $user['id'];
				$_SESSION['user'] = $user['login'];
				$_SESSION['status'] = $user['status'];
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['message']['auth'] = 'Вы успешно авторизировались';
				header('Location: /');
			} else {
				$content = '
					<p class="paragraph">Вы ввели неправильный пароль</p>
				';
				$content .= $form;
			}
		} else {
			$content = '
				<p class="paragraph">Вы ввели неправильную пару логин/пароль</p>
			';		
			$content .= $form;
		}
	}
	$title = 'Авторизация';
	include 'layout.php';

?>
