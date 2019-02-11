<?php require ('php/header.php');
include_once('php/fanction.php');
$view = new view();
 ?>
	<div class="contact-center">	
		<?php include_once('show.php') ?>
	</div>
	<?php $view->get_contact_view(); ?>
	<?php include_once('php/footer.php') ?>
</body>
</html>