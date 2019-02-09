<?php
include_once('php/fanction.php');
$admin = adminlog();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>ЭПСс</title>
	<link rel="stylesheet" href="maincss/style.css">
</head>
<body>
	<div id="gray"></div>
	<div class="header-top">
		<div class="logo">
			<a href="/">KazahGame</a>
		</div>
		<ul class="menu" >
			<li><a href="/news.php">Новости</a></li>
			<li><a href="/contact.php">Контакты</a></li>
			<li><a href="/about.php">О нас</a></li>
			<li><a href="/partners.php">Наши партнеры </a></li>
		</ul>		
	</div>
<?php
if (!isset($_GET["action"] ) ) $_GET["action"] = "dbshow";
switch ( $_GET["action"] )
{
case "dbshow":
get_News1();
break;
case "delete":
delete_item();
break;
case "editform":
get_edit_item_form();
break;
case "update":
update_item(); break;
case "addform":
get_add_item_form();
break;
case "add":
add_item(); break;
default:
get_News1();
}
?>


	</div>
	<?php include_once('php/footer.php') ?>
</body>
</html>