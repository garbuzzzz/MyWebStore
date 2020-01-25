<div id="footer_left"><p>Тут оформление футера</p></div>
<div id="footer_right">
	<ul>
		<li><a href="/">Вернуться на главную</a></li>
		<?php
			if(isset($_SESSION['status']) and $_SESSION['status'] == 'admin') {
				echo '<li><a href="admin.php">Перейти на страницу админа</a></li>';
			}
		?>
	</ul>
</div>

