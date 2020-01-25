<?	
	include 'elems/init.php';
	include 'elems/sql.php';
	
	$form = "
		<form action=\"\" method=\"GET\" class=\"reg\">
			<p>Введите свой логин</p>
			<input name=\"login\"><br><br>
			<p>Введите свой пароль</p>
			<input type=\"password\" name=\"password\"><br><br>
			<p>Повторите пароль</p>
			<input type=\"password\" name=\"confirm\"><br><br>
			<input type=\"submit\" name=\"submit\" value=\"Зарегистрироваться\">
		</form>
	";
	$content = '
		<p class="paragraph">Здесь вы увидите наикрасивейшее окно регистрации:</p>
	';
	$content .= $form;
	
	if(!empty($_GET['submit'])) {
		if(!empty($_GET['login']) and !empty($_GET['password']) and !empty($_GET['confirm'])) { 
			if($_GET['password'] == $_GET['confirm']) {
				$login = $_GET['login'];
				$query = "SELECT * FROM users WHERE login='$login'";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$user = mysqli_fetch_assoc($result);
				if(empty($user)) {
					$password = password_hash($_GET['password'], PASSWORD_DEFAULT);
					$query = "INSERT INTO users SET login='$login', password='$password', status='user'";
					mysqli_query($link, $query) or die(mysqli_error($link));
					$_SESSION['auth']= true;
					$_SESSION['id'] = mysqli_insert_id($link);
					$_SESSION['status'] = 'user';
					$_SESSION['user'] = $login;
					$_SESSION['user_id'] = mysqli_insert_id($link);
					$_SESSION['message']['reg'] = 'Вы успешно зарегистрировались и авторизировались';
					header('Location: /');
				} else {
					$content = '
					<p class="paragraph">Юзер с таким логином уже существует. Повторите:</p>
					'; 
					$content .= $form;
				}
			} else {
				$content = '
					<p class="paragraph">Введенные пароли не совпадают. Попробуйте еще раз:</p>
				'; 
				$content .= $form;
			}
		} else {
			$content = '
				<p class="paragraph">Вы не заполнили форму. Давайте-ка заполняйте еще раз, пока путиноиды вас не захватили.</p>
			'; 
			$content .= $form;
		}
	}	
	
	$title = 'Регистрация';	
	include 'layout.php';
 ?>
