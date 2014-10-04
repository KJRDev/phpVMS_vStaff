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
<?php
if(!$online_staff)
{
        echo 'No Staff Members Are Online!';
        return;
   
}
foreach($online_staff as $staff)
{
?>
<p><a href="<?php echo url('/profile/view/'.$staff->pilotid);?>"><?php echo PilotData::GetPilotCode($staff->code, $staff->pilotid). ' ' .$staff->firstname . ' ' . $staff->lastname?></a></p>
<?php
}
?>