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
<h3>View Staff Member - <?php echo $staff->firstname.' '.$staff->lastname; ?> (<?php echo $staff->titleabr;?>)</h3>
<?php if(isset($message)) { echo '<div id="success">'.$message.'</div>'; }?>
<table width="0" border="0">
  <tr>
  <td rowspan="5">
    <?php if (empty($staff->picturelink))
    {
    	echo '<img src="'.SITE_URL.'/staff_photos/nophoto.jpg"/>';
    }
    else
    {
    	echo '<img src="'.SITE_URL.'/staff_photos/'.$staff->picturelink.'" width="220" height="138" />';
    }
    ?></td>
    <td><strong>Name:</strong></td>
    <td><?php echo $staff->firstname.' '.$staff->lastname; ?> - <a href="<?php echo url('profile/view/'.$staff->pilotid);?>">View Profile</a></td>
  </tr>
  <tr>
  	
    <td><strong>Position:</strong></td>
    <td><?php echo $staff->title; ?> (<?php echo $staff->titleabr;?>)</td>
  </tr>
  <tr>
    <td><strong>Email:</strong></td>
    <td><a href="mailto:<?php echo $staff->email;?>"><?php echo $staff->email;?></a></td>
  </tr>
   <tr>
    <td><strong>Staff Bio:</strong></td>
    <td>
    <?php if (empty($staff->bio))
    {
    	echo 'No Bio Yet!';
    }
    else
    {
    	echo html_entity_decode($staff->bio);
    }
    ?></td>
  </tr>
</table>
