<?php include_once('php/fanction.php') ;
$view = new view();
?>
<?php include_once('php/header.php'); ?>
<div class="news">
<div class="news-center-item"> 
    <?php include_once('show.php'); ?>
</div>
<?php $view->get_news_view(); ?>
</div>
</body>
</html>