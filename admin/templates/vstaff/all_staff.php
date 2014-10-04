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
<h3>Current Staff List</h3>
<table width="600" class="tablesorter" id="tabledlist">
<?php
if(!$stafflevels)
{
echo 'There is no staff!';
$stafflevels = array();
}
foreach($stafflevels as $level)
{
?>
    <tr>
        <th>
        <form action="<?php echo adminurl('/vStaffListAdmin');?>" method="post">
Name: <input type="text" name="name" value="<?php echo $level->name;?>"/>
Order: <input type="text" name="order" value="<?php echo $level->order;?>"/>
<input type="hidden" name="id" value="<?php echo $level->id;?>" />
<input type="hidden" name="action" value="editcategory" />
<input type="submit" name="submit" value="Update Staff Category" />
</form>
</th>
<th>
<form action="<?php echo adminurl('/vStaffListAdmin');?>" method="post">
<input type="hidden" name="id" value="<?php echo $level->id;?>" />
<input type="hidden" name="action" value="deletecategory" />
<input type="submit" name="submit" value="Delete Staff Category" />
</form>
</th>
    </tr>
    <?php
    $allstaff = vStaffListData::GetAllStaffInCat($level->id);
        if(!$allstaff)
        {
        $allstaff = array();
        echo '<tr class="row0"><td align="center" colspan="5">No Staff Members</td></tr>';
        }
        foreach($allstaff as $staff)
        {
    ?>
	<tr>
    <td align="center"><?php if($staff->pilotid == 0)
    					{
                        	echo 'VACANT';
                        }
                        else
                        {
                        	echo PilotData::getPilotCode($staff->code, $staff->pilotid).' '.$staff->firstname.' '.$staff->lastname;
                        }
                        ?></td>
	<td align="center"><?php echo $staff->title;?> (<?php echo $staff->titleabr;?>)</td>
    <td align="center"><?php echo $staff->order;?></td>
    <td align="center"><?php echo $staff->email;?></td>
    <td align="center">
    <a href="<?php echo adminurl('/vStaffListAdmin/editstaff/'.$staff->id.'');?>">Edit Staff</a> |
    <a href="<?php echo adminurl('/vStaffListAdmin/deletestaff/'.$staff->id.'');?>">Delete Staff</a>
	</tr>
<?php
}
}
?>
</table>