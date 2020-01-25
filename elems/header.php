<?php
	 if(isset($_SESSION['auth']) and $_SESSION['auth'] == true) {
		$user_id = $_SESSION['user_id'];
		echo 
		"
			<div id=\"auth\">
				<a href=\"logout.php\">Выйти</a>
				<p>Вы зашли как {$_SESSION['user']}</p>
			</div>
			<a href=\"basket.php?id=$user_id\" id=\"basket\">Корзина</a>
		";
		 
		 

	 } else {
		 echo '
			<div id="auth">
				<a href="login.php">Авторизируйтесь</a>
				<p>Еще не авторизированы?? <a href="registration.php" id="reg">Регистрация</a></p>
			</div>
			';
	 }
?>