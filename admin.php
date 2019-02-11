<?php
include_once('php/fanction.php');
include_once('adminpanel/admin-header.php');
 $newsadmin = new adminNews();?>
<?php
if (!isset($_GET["action"] ) ) $_GET["action"] = "dbshow";
switch ( $_GET["action"] )
{
case "dbshow":
$newsadmin->get_News1();
break;
case "delete":
$newsadmin->delete_item();
break;
case "editform":
$newsadmin->get_edit_item_form();
break;
case "update":
$newsadmin->update_item(); break;
case "addform":
$newsadmin->get_add_item_form();
break;
case "add":
$newsadmin->add_item(); break;
default:
$newsadmin->get_News1();
}
?>
	</div>
	<?php include_once('php/footer.php') ?>
</body>
</html>