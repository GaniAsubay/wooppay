<?php 
include_once('php/fanction.php');
include_once('php/header.php');
$get_article = new view();
 ?>
<div class="article-center">
	<?php
	$get_article->get_article_view();
?>
</div>


 <?php include_once('php/footer.php') ?>
</body>
</html>