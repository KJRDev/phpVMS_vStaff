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
class vStaff extends CodonModule
{
	public $title = "Staff";
	
	public function index()
	{
		$this->set('stafflevels', vStaffListData::GetAllStaffLevels());
		$this->render('vstaff/index.tpl');
	}
	
	public function view($id = '')
	{
		if($id == '')
		{
			$this->set('message', 'No Staff ID Entered!');
			$this->render('core_error.tpl');
			return false;	
		}
		elseif(!vStaffListData::getStaff($id))
		{
			$this->set('message', 'No Staff Such Exists!');
			$this->render('core_error.tpl');
			return false;
		}
		
        $this->set('staff', vStaffListData::getStaff($id));
		$this->render('vstaff/view_staff.tpl');
	}
	
	public function show_online_staff($minutes = '')
	{
		$this->set('online_staff', vStaffListData::GetOnlineStaff($minutes));
        $this->render('vstaff/online_staff.tpl');
	}
}