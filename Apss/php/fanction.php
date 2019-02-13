<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

/*connection db*/
function connectionDB(){
	global $mysqli;
	$mysqli = new mysqli('localhost','root','','it_company');
	$mysqli->query("SET CHARSET utf8");
}
function closeDB(){
	global $mysqli;
	$mysqli->close();
}
/*connection db*/
/*query db*/
function get_News() {
	global $mysqli;
	connectionDB();
	$result = $mysqli->query("SELECT * FROM `news` ORDER BY `id`DESC");
	closeDB();
	return resultToArray ($result);
}
function get_contact() {
	global $mysqli;
	connectionDB();
	$result = $mysqli->query("SELECT * FROM `contact` ORDER BY `id`");
	closeDB();
	return resultToArray ($result);
}
function get_about() {
	global $mysqli;
	connectionDB();
	$result = $mysqli->query("SELECT * FROM `about` ORDER BY `id`");
	closeDB();
	return resultToArray ($result);
}
function get_partners() {
	global $mysqli;
	connectionDB();
	$result = $mysqli->query("SELECT * FROM `partners` ORDER BY `id`");
	closeDB();
	return resultToArray ($result);
}
function get_article($id) {
global $mysqli;
connectionDB();
$result = $mysqli->query("SELECT * FROM `news` WHERE `id` = ".$id."");
closeDB();
return resultToArray($result);
}
function resultToArray ($result) {
	$array = array();
	while (($row = $result-> fetch_assoc()) != false) {
		$array[] = $row;
	}
	return $array;
}
/*query db*/
/*admin*/
function adminlog(){
	if(isset($_POST['login']) && isset($_POST['password'])){
	$login = $_POST['login'];
	$password = $_POST['password'];
	global $mysqli;
	connectionDB();
	$sql = mysqli_query($mysqli,"SELECT *  FROM `login` WHERE `login`= '$login' AND `password`= '$password'");
	if(mysqli_num_rows($sql) !== 0) 
		echo "<script>self.location='http://apss/admin.php';</script>"; 
}
}
/*admin*/
/*function view*/
class view{
	function get_article_view(){
		$article = get_article($_GET["id"]);
		for ($i=0; $i <count($article) ; $i++) {
		echo "<div class = 'article-items'>";
		echo "<h1>";
		echo $article[$i]['title'],"<br>";
		echo "</h1>";
		echo "<img src= images/news-items/".$article[$i]['title'].".jpg>","<br>";
		echo "<p>".$article[$i]["text"],"</p>", "<br>";
		echo "<h4>Автор: ".$article[$i]["author"]." </h4>";
		echo "<h4>Дата: ".$article[$i]["date"]." </h4>";
		echo "</div>";
	}
	}
	function get_news_view(){
		$news = get_News();
		for ($i=0; $i <count($news) ; $i++) {
			echo "<div class = 'article'>";
			echo "<h2>";
			echo $news[$i]["title"],"<br>";
			echo "</h2>";
			echo "<img src = images/news-items/".$news[$i]["title"].".jpg>","<br>";
			echo "<div class='text'>".$news[$i]["text"]."</div><br>";
			echo "<br>";
			echo "<h4>Автор : </h4";
			echo "<br>";
			echo $news[$i]["author"],"<br>";
			echo "<h4>Дата поста : </h4";
			echo "<br>";
			echo $news[$i]["date"],"<br>";
			echo "<a href=/article.php?id=".$news[$i]["id"]."><div class='button'>Подробнее</div></a>";
			echo "</div>";
		}
	}
	function get_contact_view(){
		$news = get_contact();
		echo "<div class= 'admin-center-item'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>ФИО</th>";
		echo "<th>Должность</th>";
		echo "<th>Номер телефона</th>";
		echo "<th>Email</th>";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['Full_Name']."</td>";
			echo "<td>".$news[$i]['position']."</td>";
			echo "<td>".$news[$i]['number']."</td>";
			echo "<td>".$news[$i]['email']."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	}
	function get_about_view(){
		$news = get_about();
		for ($i=0; $i <count($news) ; $i++) {
			echo "<div class = 'about'>";
			echo "<div class = 'about-info'>";
			echo "<h3>";
			echo $news[$i]["name_company"],"<br>";
			echo "</h3>";
			echo "<div class='info-company'>".$news[$i]["info_company"]."</div><br>";
			echo "<br>";
			echo "</div>";
			echo "<div class = 'about-img'>";
			echo "<img src = images/about-items/".$news[$i]["name_company"].".png>","<br>";
			echo "<div class='adress-company'>Адрес: ".$news[$i]["adress_company"]."</div>";
			echo "</div>";
			echo "</div>";
		}
	}
	function get_partners_view(){
		$news = get_partners();
		echo "<div class= 'admin-center-item'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>Название</th>";
		echo "<th>Проект</th>";
		echo "<th>Статус</th>";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['partners_name']."</td>";
			echo "<td>".$news[$i]['name_project']."</td>";
			echo "<td>".$news[$i]['status']."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
	}
}
/*function view*/
/*function admin_news*/
class adminNews{
	function get_news1(){
		$news = get_News();
		echo	"<div class= 'admin-center-item'>";
		echo "<div class='table-item'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Название</th>";
		echo "<th>Автор</th>";
		echo "<th>Дата</th>";
		echo "<th>Действия</th>";
		echo "<th>Действия</th>	";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['id']."</td>";
			echo "<td>".$news[$i]['title']."</td>";
			echo "<td>".$news[$i]['author']."</td>";
			echo "<td>".$news[$i]['date']."</td>";
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id='.$news[$i]['id'].'">Редактировать</a></td>';
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$news[$i]['id'].'">Удалить</a></td>';
			echo "</tr>";
		}
		echo "</table>";
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=addform">Новая запись</a></td>';
		echo "</div>";
	}
	function delete_item(){
		global $mysqli;
		connectionDB();
		$result = $mysqli->query("DELETE FROM news WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/admin.php';</script>";
	}
	function get_edit_item_form()
	{
		echo '<h2Редактировать</h2>';
		global $mysqli;
		connectionDB();
		$result= $mysqli->query("SELECT title, text, author, date FROM news WHERE id=".$_GET['id']);
		closeDB();
		while (($row = $result-> fetch_assoc())!= false)
		{
			echo '<form name= "editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id='.$_GET['id'].'" method="POST">';
			echo '<table>';
			echo '<tr>';
			echo '<td>Название</td>';
			echo '<td><input type="text" name="title" value="'.$row['title'].'" required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Текст</td>';
			echo '<td><textarea name="text" required>'.$row['text'].'</textarea></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Автор</td>';
			echo '<td><input type="text" name="author" value="'.$row['author'].'"required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Дата</td>';
			echo '<td><input type="date" name="date" value="'.$row['date'].'"required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><input type="submit" value="Изменить"></td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';
		}
	}
	function update_item()
	{
		$title=($_POST['title']);
		$text=($_POST['text']);
		$author=($_POST['author']);
		$date = $_POST['date'];
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("UPDATE news SET title='".$title."',text='".$text."',author='".$author."', date='".$date."'WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/admin.php';</script>";
	}
	function get_add_item_form()
	{
		echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
		echo '<table>';
		echo '<tr>';
		echo '<td>Название</td>';
		echo '<td><input type="text" name="title" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Текст</td>';
		echo '<td><textarea name="text"  value="" required></textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Автор</td>';
		echo '<td><input type="text" name="author" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Дата</td>';
		echo '<td><input type="date" name="date" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Сохронить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
	}
	function add_item()
	{
		$title=($_POST['title']);
		$text=($_POST['text']);
		$author=($_POST['author']);
		$date = $_POST['date'];
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("INSERT INTO `news` (`id`, `title`, `text`, `author`, `date`) VALUES (NULL, '".$title."', '".$text."', '".$author."', '".$date."')");
		closeDB();
		echo "<script>self.location='http://apss/admin.php';</script>";
	}
}
/*function admin_news*/
/*function admin_contact*/
class adminContact{
	function get_admin_contact_view(){
		$news = get_contact();
		echo	"<div class= 'admin-center-item'>";
		echo "<div class='table-item'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>ФИО</th>";
		echo "<th>Должность</th>";
		echo "<th>Номер телефона</th>";
		echo "<th>Email</th>";
		echo "<th>Действия</th>";
		echo "<th>Действия</th>	";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['id']."</td>";
			echo "<td>".$news[$i]['Full_Name']."</td>";
			echo "<td>".$news[$i]['position']."</td>";
			echo "<td>".$news[$i]['number']."</td>";
			echo "<td>".$news[$i]['email']."</td>";
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id='.$news[$i]['id'].'">Редактировать</a></td>';
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$news[$i]['id'].'">Удалить</a></td>';
			echo "</tr>";
		}
		echo "</table>";
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=addform">Новая запись</a></td>';
		echo "</div>";
	}
	function get_edit_item_form()
	{
		echo '<h2Редактировать</h2>';
		global $mysqli;
		connectionDB();
		$result= $mysqli->query("SELECT Full_Name, position, number, email FROM contact WHERE id=".$_GET['id']);
		closeDB();
		while (($row = $result-> fetch_assoc())!= false)
		{
			echo '<form name= "editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id='.$_GET['id'].'" method="POST">';
			echo '<table>';
			echo '<tr>';
			echo '<td>ФИО</td>';
			echo '<td><input type="text" name="Full_Name" value="'.$row['Full_Name'].'" required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Должность</td>';
			echo '<td><input type="text" name="position" value="'.$row['position'].'" required></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>номер телефона</td>';
			echo '<td><input type="number" name="number" value="'.$row['number'].'" required></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Email</td>';
			echo '<td><input type="email" name="email" value="'.$row['email'].'" required></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><input type="submit" value="Изменить"></td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';
		}
	}
	function update_item()
	{
		$Full_Name=($_POST['Full_Name']);
		$position=($_POST['position']);
		$number=($_POST['number']);
		$email = $_POST['email'];
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("UPDATE contact SET Full_Name='".$Full_Name."',position='".$position."',number='".$number."', email='".$email."'WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-contact.php';</script>";
	}
	function delete_item(){
		global $mysqli;
		connectionDB();
		$result = $mysqli->query("DELETE FROM contact WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-contact.php';</script>";
	}
	function get_add_item_form()
	{
		echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
		echo '<table>';
		echo '<tr>';
		echo '<td>ФИО</td>';
		echo '<td><input type="text" name="Full_Name" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Должность</td>';
		echo '<td><input type="text" name="position" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Номер телефона</td>';
		echo '<td><input type="number" name="number" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Email</td>';
		echo '<td><input type="email" name="email" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Сохронить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
	}
	function add_item()
	{
		$Full_Name=($_POST['Full_Name']);
		$position=($_POST['position']);
		$number=($_POST['number']);
		$email = $_POST['email'];
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("INSERT INTO `contact` (`id`, `Full_Name`, `position`, `number`, `email`) VALUES (NULL, '".$Full_Name."', '".$position."', '".$number."', '".$email."')");
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-contact.php';</script>";
	}
}
/*function admin_contact*/
/*function admin_about*/
class adminAbout{
	function get_admin_contact_view(){
		$news = get_about();
		echo "<div class= 'admin-center-item'>";
		echo "<div class='table-item-about'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Название</th>";
		echo "<th>Информация</th>";
		echo "<th>Адрес</th>";
		echo "<th>Действия</th>";
		echo "<th>Действия</th>	";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['id']."</td>";
			echo "<td>".$news[$i]['name_company']."</td>";
			echo "<td>".$news[$i]['info_company']."</td>";
			echo "<td>".$news[$i]['adress_company']."</td>";
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id='.$news[$i]['id'].'">Редактировать</a></td>';
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$news[$i]['id'].'">Удалить</a></td>';
			echo "</tr>";
		}
		echo "</table>";
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=addform">Новая запись</a></td>';
		echo "</div>";
		echo "</div>";
	}
	function get_edit_item_form()
	{
		echo '<h2Редактировать</h2>';
		global $mysqli;
		connectionDB();
		$result= $mysqli->query("SELECT name_company, info_company, adress_company FROM about WHERE id=".$_GET['id']);
		closeDB();
		while (($row = $result-> fetch_assoc())!= false)
		{
			echo '<form name= "editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id='.$_GET['id'].'" method="POST">';
			echo '<table>';
			echo '<tr>';
			echo '<td>Название</td>';
			echo '<td><input type="text" name="name_company" value="'.$row['name_company'].'" required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Информация</td>';
			echo '<td><textarea name="info_company" required>'.$row['info_company'].'</textarea></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Адрес</td>';
			echo '<td><input type="text" name="adress_company" value="'.$row['adress_company'].'" required></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><input type="submit" value="Изменить"></td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';
		}
	}
	function update_item()
	{
		$name_company=($_POST['name_company']);
		$info_company=($_POST['info_company']);
		$adress_company=($_POST['adress_company']);
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("UPDATE about SET name_company='".$name_company."',info_company='".$info_company."',adress_company='".$adress_company."' WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-about.php';</script>";
	}
	function delete_item(){
		global $mysqli;
		connectionDB();
		$result = $mysqli->query("DELETE FROM about WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-about.php';</script>";
	}
	function get_add_item_form()
	{
		echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
		echo '<table>';
		echo '<tr>';
		echo '<td>Название</td>';
		echo '<td><input type="text" name="name_company" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Информация</td>';
		echo '<td><textarea name="info_company" required></textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Адрес</td>';
		echo '<td><input type="text" name="adress_company" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Сохронить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
	}
	function add_item()
	{
		$name_company=($_POST['name_company']);
		$info_company=($_POST['info_company']);
		$adress_company=($_POST['adress_company']);
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("INSERT INTO `about` (`id`, `name_company`, `info_company`, `adress_company`) VALUES (NULL, '".$name_company."', '".$info_company."', '".$adress_company."')");
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-about.php';</script>";
	}
}
/*function admin_about*/
/*function admin_partners*/
class adminPartners{
	function get_admin_contact_view(){
		$news = get_partners();
		echo "<div class= 'admin-center-item'>";
		echo "<div class='table-item'>";
		echo "<table border='2' cellpadding='2' cellspacing='0'>";
		echo "<tr>";
		echo "<th>Название</th>";
		echo "<th>Проект</th>";
		echo "<th>Статус</th>";
		echo "<th>Действия</th>";
		echo "<th>Действия</th>	";
		echo "</tr>";
		for ($i=0; $i <count($news) ; $i++) {
			echo "<tr>";
			echo "<td>".$news[$i]['partners_name']."</td>";
			echo "<td>".$news[$i]['name_project']."</td>";
			echo "<td>".$news[$i]['status']."</td>";
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id='.$news[$i]['id'].'">Редактировать</a></td>';
			echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id='.$news[$i]['id'].'">Удалить</a></td>';
			echo "</tr>";
		}
		echo "</table>";
		echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=addform">Новая запись</a></td>';
		echo "</div>";
		echo "</div>";
	}
	function get_edit_item_form()
	{
		echo '<h2Редактировать</h2>';
		global $mysqli;
		connectionDB();
		$result= $mysqli->query("SELECT partners_name, name_project, status FROM partners WHERE id=".$_GET['id']);
		closeDB();
		while (($row = $result-> fetch_assoc())!= false)
		{
			echo '<form name= "editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id='.$_GET['id'].'" method="POST">';
			echo '<table>';
			echo '<tr>';
			echo '<td>Название</td>';
			echo '<td><input type="text" name="partners_name" value="'.$row['partners_name'].'" required ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Проект</td>';
			echo '<td><textarea name="name_project" required>'.$row['name_project'].'</textarea></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>Статус</td>';
			echo '<td><p><select name="status">';
            echo '<option value="В разработке">В разработке</option>';
            echo '<option value="Выполнено" >Выполнено</option>';
            echo '</select></p></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td><input type="submit" value="Изменить"></td>';
			echo '</tr>';
			echo '</table>';
			echo '</form>';
		}
	}
	function update_item()
	{
		$partners_name=($_POST['partners_name']);
		$name_project=($_POST['name_project']);
		$status=($_POST['status']);
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("UPDATE partners SET partners_name='".$partners_name."',name_project='".$name_project."',status='".$status."' WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-partners.php';</script>";
	}
	function delete_item(){
		global $mysqli;
		connectionDB();
		$result = $mysqli->query("DELETE FROM partners WHERE id=".$_GET['id']);
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-partners.php';</script>";
	}
	function get_add_item_form()
	{
		echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
		echo '<table>';
		echo '<tr>';
		echo '<td>Название</td>';
		echo '<td><input type="text" name="partners_name" value="" required></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Проект</td>';
		echo '<td><textarea name="name_project" required></textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Статус</td>';
		echo '<td><p><select name="status" >';
        echo '<option value="В разработке">В разработке</option>';
        echo '<option value="Выполнено">Выполнено</option>';
        echo '</select></p> </td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="submit" value="Сохронить"></td>';
		echo '</tr>';
		echo '</table>';
		echo '</form>';
	}
	function add_item()
	{
		$partners_name=($_POST['partners_name']);
		$name_project=($_POST['name_project']);
		$status=($_POST['status']);
		global $mysqli;
		connectionDB();
		$result=$mysqli->query("INSERT INTO `partners` (`id`, `partners_name`, `name_project`, `status`) VALUES (NULL, '".$partners_name."', '".$name_project."', '".$status."')");
		closeDB();
		echo "<script>self.location='http://apss/adminpanel/admin-partners.php';</script>";
	}
}
/*function admin_partners*/