<?php
include_once('../php/fanction.php');
include_once('admin-header.php');
$contactadmin = new adminContact();
?>
<?php
if (!isset($_GET["action"] ) ) $_GET["action"] = "dbshow";
switch ( $_GET["action"] )
{
case "dbshow":
$contactadmin->get_admin_contact_view();
break;
case "delete":
$contactadmin->delete_item();
break;
case "editform":
$contactadmin->get_edit_item_form();
break;
case "update":
$contactadmin->update_item(); break;
case "addform":
$contactadmin->get_add_item_form();
break;
case "add":
$contactadmin->add_item(); break;
default:
$contactadmin->get_admin_contact_view();
}
?>
	</div>
	<?php include_once('../php/footer.php') ?>
</body>
</html>