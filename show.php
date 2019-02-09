<?php
include_once('php/fanction.php');
$admin = adminlog();
?>
<div id="registerform">
			<div class="close">
				<img src="images/close.png" alt="close" id="close" onclick="show('none')">
			</div>
			<div class="formreg">
				
				<form action="show.php" method="POST">
					<h2>Войти</h2>
					<input type="text" placeholder="Логин" name="login" class="input" required>
					<input type="password" placeholder="Пароль" name="password" class="input" required>
					<input type="submit" value="Отправить запрос" name="sab" class="input">
				</form>
			</div>
</div>
