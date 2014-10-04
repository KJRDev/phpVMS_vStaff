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
<h3>Edit Staff</h3>
<form action="<?php echo adminurl('/vStaffListAdmin');?>" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
<tr>
<td align="center" colspan="2"><strong>Staff Information</strong></td>
</tr>
<tr>
    <td><strong>Member:</strong></td>
    <td><select name="pilotid">
    	<?php $true = ($staff->memberid == 0) ? "selected=\"selected\"": '';
        	echo "<option value=\"0\" {$true}>VACANT</option>";?>
        <?php
        foreach($pilots as $pilot) {
        $selected = ($staff->pilotid == $pilot->pilotid) ? "selected=\"selected\"": '';
            echo "<option value=\"{$pilot->pilotid}\" {$selected}>{$pilot->pilotid} - {$pilot->firstname} {$pilot->lastname}</option>";
        }
        ?>
        </select></td>
</tr>
<tr>
    <td><strong>Staff Category:</strong></td>
    <td><select name="level_id">
        <?php
        foreach($allcategories as $cat) {
        $selected = ($staff->level_id == $cat->id) ? "selected=\"selected\"": '';
            echo "<option value=\"{$cat->id}\" {$selected}>{$cat->name}</option>";
        }
        ?>
        </select></td>
</tr>
<tr>
    <td><strong>Staff Title:</strong></td>
    <td><input type="text" name="title" value="<?php echo $staff->title;?>"/></td>
</tr>
<tr>
    <td><strong>Title Abbrv.:</strong></td>
    <td><input type="text" name="titleabr" value="<?php echo $staff->titleabr;?>"/></td>
</tr>
<tr>
    <td><strong>Email:</strong></td>
    <td><input type="text" name="email" value="<?php echo $staff->email;?>"/></td>
</tr>
<tr>
    <td><strong>Order:</strong></td>
    <td><input type="text" name="order" value="<?php echo $staff->order;?>"/></td>
</tr>
<tr>
    <td><strong>Staff Photo:</strong></td>
    <td><?php if (empty($staff->picturelink))
    {
    	echo 'No Image Uploaded!';
    }
    else
    {
    	echo '<img src="'.SITE_URL.'/staff_photos/'.$staff->picturelink.'" width="220" height="138" />';
    }
    ?></td>
</tr>
<tr>
    <td><strong>Upload A New Staff Photo:</strong></td>
    <td><input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
    	<input type="file" name="uploadedfile" />
		</td>
</tr>
<?php if (!empty($staff->picturelink))
{
?>
<tr>
    <td><strong>Remove Staff Photo?:</strong></td>
    <td><input type="checkbox" name="remove_photo" value="true" /></td>
</tr>
<?php
}
?>
<tr>
<td align="center" colspan="2" class="rowheader"><strong>Bio</strong></td>
</tr>
<tr>
    <td colspan="2"><textarea name="bio" id="editor" style="width: 500px; height: 180px;"><?php if(isset($staff->bio)) { echo $staff->bio;}?></textarea></td>
</tr>
<tr>
<td align="center" colspan="2" class="rowheader"><strong>Update Staff</strong></td>
</tr>
<tr>
    <td colspan="2" align="center"><input type="hidden" name="action" value="editstaff" />
<input type="hidden" name="id" value="<?php echo $staff->id; ?>" />
<input type="submit" name="submit" value="Save Staff" /></td>
</tr>
</table>
</form>
</div>