<?php
include_once('../php/fanction.php');
include_once('admin-header.php');
$aboutadmin = new adminAbout();
?>
<?php
if (!isset($_GET["action"] ) ) $_GET["action"] = "dbshow";
switch ( $_GET["action"] )
{
case "dbshow":
$aboutadmin->get_admin_contact_view();
break;
case "delete":
$aboutadmin->delete_item();
break;
case "editform":
$aboutadmin->get_edit_item_form();
break;
case "update":
$aboutadmin->update_item(); break;
case "addform":
$aboutadmin->get_add_item_form();
break;
case "add":
$aboutadmin->add_item(); break;
default:
$aboutadmin->get_admin_contact_view();
}
?>
	</div>
	<?php include_once('../php/footer.php') ?>
</body>
</html>