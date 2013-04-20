<?php
/*
Module Created By Vansers-Add-Ons (Vansers)
This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)
@Created By Vansers
@Copyrighted @ 2013


Version 1.0 (April.20.13) - Module Created

TO INSTALL MODULE:

1) Place the files as structured in the folder into your phpVMS Install location

2) Please run the sql_install.sql in your phpVMS as this will insert two tables for functionally of the module.

3) Enjoy!

MODULE LINKS TO ADD TO YOUR WEBSITE. THE ADMIN LINK IS ALREADY ADDED.

<?php echo url('/vStaff'); ?>
*/
?>
<h3>Add Staff Category</h3>
<form action="<?php echo adminurl('/vStaffListAdmin');?>" method="post">
<strong>Category Name: </strong><input type="text" name="name" /> || <strong>Order: </strong><input type="text" name="order"/>
<input type="hidden" name="action" value="addstaffcat" />
<input type="submit" name="submit" value="Add Staff Category" />
</form>