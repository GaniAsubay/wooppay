<?php 
function connectionDB(){
	global $mysqli;
	$mysqli = new mysqli('localhost','root','','account');
	$mysqli->query("SET CHARSET utf8");
}
function closeDB(){
	global $mysqli;
	$mysqli->close();
}

function get_News() {
	global $mysqli;
	connectionDB();
	$result = $mysqli->query("SELECT * FROM `news` ORDER BY `id`DESC");
	closeDB();
	return resultToArray ($result);
}

function resultToArray ($result) {
	$array = array();
	while (($row = $result-> fetch_assoc()) != false) {
		$array[] = $row;
	}
	return $array;
}
function adminlog(){
	$login = $_POST['login'];
	$password = $_POST['password'];
	$but = $_POST['sub'];
	global $mysqli;
	connectionDB();
	$sql = mysqli_query($mysqli,"SELECT *  FROM `login` WHERE `login`= '$login' AND `password`= '$password'");
	if(mysqli_num_rows($sql) !== 0) {
		header("Location:/admin.php");
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
		echo "<a href=index.php?id=".$news[$i]["id"]."><div class='button'>Подробнее</div></a>";
		echo "</div>";
	}
}
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
		$array[] = $row;

		echo '<form name= "editform" action="'.$_SERVER['PHP_SELF'].'?action=update&id='.$_GET['id'].'" method="POST">';
		echo '<table>';
		echo '<tr>';
		echo '<td>Название</td>';
		echo '<td><input type="text" name="title" value="'.$row['title'].'" ></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Текст</td>';
		echo '<td><textarea name="text">'.$row['text'].'</textarea></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Автор</td>';
		echo '<td><input type="text" name="author" value="'.$row['author'].'" ></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>Дата</td>';
		echo '<td><input type="date" name="date" value="'.$row['date'].'" ></td>';
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
echo '<h2>Добавить</h2>';
echo '<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">';
echo '<table>';
echo '<tr>';
echo '<td>Название</td>';
echo '<td><input type="text" name="title" value="" /></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Текст</td>';
echo '<td><textarea name="text" name="text" value=""></textarea></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Автор</td>';
echo '<td><input type="text" name="author" value="" /></td>';
echo '</tr>';
echo '<tr>';
echo '<td>Дата</td>';
echo '<td><input type="date" name="date"/></td>';
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