<?php
include_once('../php/fanction.php');
include_once('admin-header.php');
$partnersadmin = new adminPartners();
?>
<?php
if (!isset($_GET["action"] ) ) $_GET["action"] = "dbshow";
switch ( $_GET["action"] )
{
case "dbshow":
$partnersadmin->get_admin_contact_view();
break;
case "delete":
$partnersadmin->delete_item();
break;
case "editform":
$partnersadmin->get_edit_item_form();
break;
case "update":
$partnersadmin->update_item(); break;
case "addform":
$partnersadmin->get_add_item_form();
break;
case "add":
$partnersadmin->add_item(); break;
default:
$partnersadmin->get_admin_contact_view();
}
?>
	</div>
	<?php include_once('../php/footer.php') ?>
</body>
</html>