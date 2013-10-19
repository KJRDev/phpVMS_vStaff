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
class vStaffListData extends CodonData {
	
	public static function GetAllStaffLevels()
	{
		$sql = 'SELECT * FROM staff_levels
				ORDER BY `order` ASC';
		return DB::get_results($sql);
	}
	
	public static function GetAllStaffInCat($cat_level)
	{
		$sql = 'SELECT s.*, p.*, s.email AS email
		FROM staff_members s
		LEFT JOIN '.TABLE_PREFIX.'pilots p ON p.pilotid=s.pilotid
		WHERE s.level_id ='.$cat_level.'
		ORDER BY s.order ASC';
		return DB::get_results($sql);
	}
	
	public static function getStaffInfo($pilotid)
	{
		$sql = 'SELECT *
		FROM staff_members
		WHERE pilotid ='.$pilotid.'
		ORDER BY `order` ASC';
		return DB::get_row($sql);
	}
	
	public static function getStaff($id)
	{
		$sql = "SELECT s.*, p.*, s.email AS email, UNIX_TIMESTAMP(s.since) as since
				FROM staff_members s
				LEFT JOIN ".TABLE_PREFIX."pilots p ON p.pilotid=s.pilotid
				WHERE s.id = {$id}";
		return DB::get_row($sql);	
	}
	
	public static function AddCategory($name, $order) {

        $sql = "INSERT INTO staff_levels (name, `order`)
                VALUES('$name', $order)";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
    }
	
	public static function UpdateCategory($id, $name, $order) {
		
		$name = DB::escape($name);
		$order = DB::escape($order);

		$sql = "UPDATE staff_levels 
				SET name='$name', `order`='$order'
				WHERE id=$id";
		
		$res = DB::query($sql);
		
		if(DB::errno() != 0)
			return false;
		
		return true;
    }
	
	public static function AddStaff($pilotid, $level_id, $title, $titleabr, $email, $order) {
		
		$title = DB::escape($title);
		$titleabr = DB::escape($titleabr);
		$email = DB::escape($email);

        $sql = "INSERT INTO staff_members (`level_id`, `pilotid`, title, titleabr, email, `order`, since)
                VALUES($level_id, $pilotid, '$title', '$titleabr', '$email', $order, NOW())";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
    }
	
	public static function UpdateStaff($id, $pilotid, $level_id, $title, $titleabr, $email, $order, $bio) {
		
		$title = DB::escape($title);
		$titleabr = DB::escape($titleabr);
		$email = DB::escape($email);
		
		$sql = "UPDATE staff_members 
				SET `pilotid`='$pilotid', `level_id`='$level_id', title='$title', titleabr='$titleabr', email='$email', `order`='$order', bio='$bio'
				WHERE id=$id";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
    }
	
	public static function UploadPhoto($id, $picturelink)
	{
		$sql = "UPDATE staff_members 
				SET picturelink='$picturelink'
				WHERE id=$id";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
	}
	
	public static function RemovePhoto($id)
	{
		$sql = "UPDATE staff_members 
				SET picturelink=''
				WHERE id=$id";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
	}
	
	public static function DeleteCategory($id)
	{
		$sql = "DELETE FROM staff_levels
				WHERE id=$id";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
	}
	
	public static function DeleteStaff($id)
	{
		$sql = "DELETE FROM staff_members
				WHERE id=$id";

        $ret = DB::query($sql);

		if(DB::errno() != 0)
			return false;
		
		return true;
	}
	
	public static function GetOnlineStaff($minutes = '')
	{
		if($minutes == '')
			$minutes = Config::Get('USERS_ONLINE_TIME');
			
		$sql = "SELECT a.*, p.*
				FROM staff_members a, ".TABLE_PREFIX."sessions s
				LEFT JOIN ".TABLE_PREFIX."pilots p ON p.pilotid=s.pilotid 
				WHERE a.pilotid = s.pilotid
				AND DATE_SUB(NOW(), INTERVAL {$minutes} MINUTE) <= s.logintime";
				
		$staff_online = DB::get_results($sql);
        
		if(!$staff_online)
        	$staff_online = array();
			
		return $staff_online;
	}

}
