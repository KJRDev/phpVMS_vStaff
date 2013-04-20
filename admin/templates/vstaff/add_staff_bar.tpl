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
<h3>vStaffList Admin</h3>
<h3>Add Staff Member</h3>
<?php if(vStaffListData::GetAllStaffLevels()){?>
<form action="<?php echo adminurl('/vStaffListAdmin');?>" method="post">
<strong>Member: </strong>
<select name="pilotid">
<option value="0">VACANT</option>
<?php
foreach($pilots as $pilot) {
	$fullpilotid = PilotData::getPilotCode($pilot->code, $pilot->pilotid);
	echo "<option value=\"{$pilot->pilotid}\">{$fullpilotid} - {$pilot->firstname} {$pilot->lastname}</option>";
}
?>
</select>|| <strong>Category: </strong><select name="level_id">
<?php
foreach($allcategories as $cat) {
	echo "<option value=\"{$cat->id}\">{$cat->name}</option>";
}
?>
</select>|| <strong>Title: </strong><input type="text" name="title"/>|| <strong>Title Abbreviation: </strong><input type="text" name="titleabr"/>|| <strong>Email: </strong><input type="text" name="email"/>|| <strong>Order: </strong><input type="text" name="order"/>
<input type="hidden" name="action" value="addstaff" />
<input type="submit" name="submit" value="Add Staff" />
</form>
<?php } else { $this->set('message', 'You must add a staff category first before creating a staff member'); TemplateSet::show('core_error.tpl'); }?>