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
class vStaffListAdmin extends CodonModule
{
	public function HTMLHead()
	{
		$this->set('sidebar', 'vstaff/sidebar.tpl');
	}
	
	public function navbar()
	{
		if(PilotGroups::group_has_perm(Auth::$usergroups, FULL_ADMIN))
		{
		echo '<li><a href="'.SITE_URL.'/admin/index.php/vStaffListAdmin/">vStaffList Admin</a></li>';
		}
	}
	
	public function index()
	{
		if(isset($this->post->action))
		{
			switch ($this->post->action) 
			{
				case 'addstaff':
				$this->add_staff_post();
				break;
				
				case 'editstaff':
				$this->edit_staff_post();
				break;
				
				case 'deletestaff':
				$this->delete_staff_post();
				break;
				
				case 'addstaffcat':
				$this->add_staff_cat_post();
				break;
				
				case 'editcategory':
				$this->edit_staff_cat_post();
				break;
				
				case 'deletecategory':
				$this->delete_staff_cat_post();
				break;
				
			}
		}
		
		$this->set('pilots', PilotData::findPilots(array()));
		$this->set('allcategories', vStaffListData::GetAllStaffLevels());
		$this->render('vstaff/add_staff_bar.tpl');
		$this->render('vstaff/add_staff_cat_bar.tpl');
		$this->set('stafflevels', vStaffListData::GetAllStaffLevels());
		$this->render('vstaff/all_staff.tpl');
	}
	
	public function editstaff($id)
	{
		$this->set('pilots', PilotData::findPilots(array()));
		$this->set('allcategories', vStaffListData::GetAllStaffLevels());
		$this->set('staff', vStaffListData::getStaff($id));
		$this->render('vstaff/edit_staff.tpl');
	}
	
	public function deletestaff($id)
	{
		if($id == '')
		{
			$this->set('message', 'No ID Passed!');
			$this->render('core_error.tpl');
			return false;
		}
		$this->delete_staff_post($id);
		
		$this->index();
	}
	
	/*
	*
	*	Protected Functions
	*	Protected Functions
	*	Protected Functions
	*	Protected Functions
	*	Protected Functions
	*	Protected Functions
	*	Protected Functions
	*
	*/
	
	protected function add_staff_post()
	{
		if($this->post->pilotid == "" || $this->post->level_id == "" || $this->post->title == "" || $this->post->titleabr == "" || $this->post->email == "")
		{
			$this->set('message', 'Please enter everything out, Pilot, Staff Level, Title, Title Abr. & Email!');
			$this->render('core_error.tpl');
			return false;
		}
		
		$ret = vStaffListData::AddStaff($this->post->pilotid, $this->post->level_id, $this->post->title, $this->post->titleabr, $this->post->email, $this->post->order);
	}
	
	protected function edit_staff_post()
	{
		if($this->post->id == "" || $this->post->pilotid == "" || $this->post->level_id == "" || $this->post->title == "" || $this->post->titleabr == "" || $this->post->email == "")
		{
			$this->set('message', 'Please enter everything out, Pilot, Staff Level, Title, Title Abr. & Email!');
			$this->render('core_error.tpl');
			return false;
		}
		
		$ret = vStaffListData::UpdateStaff($this->post->id, $this->post->pilotid, $this->post->level_id, $this->post->title, $this->post->titleabr, $this->post->email, $this->post->order, $this->post->bio);
		
		if(isset($_FILES['uploadedfile']['type']))
		{
			$this->upload_image_post($this->post->id, $_FILES);
		}
		
		if($this->post->remove_photo == 'true' && !$_FILES['uploadedfile']['type'])
		{
			$this->remove_image_post($this->post->id);
		}
	}
	
	protected function upload_image_post($id, $_FILES)
	{
		if($id == '')
		{
			return false;	
		}
		
		if ((($_FILES["uploadedfile"]["type"] == "image/x-png")
            || ($_FILES["uploadedfile"]["type"] == "image/jpeg")
			|| ($_FILES["uploadedfile"]["type"] == "image/png")
            || ($_FILES["uploadedfile"]["type"] == "image/pjpeg")
            || ($_FILES["uploadedfile"]["type"] == "image/gif"))
            && ($_FILES["uploadedfile"]["size"] < 1048576))
        {
			
			 if ($_FILES["file"]["error"] > 0) {
                echo "Error: " . $_FILES["file"]["error"] . "<br />";
            }
			//If uploading a different folder, .. = up one folder.
            $target_path = SITE_ROOT.'staff_photos/';

            $_FILES['uploadedfile']['name'];

            $target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

            if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) 
			{
				$file_name = $_FILES['uploadedfile']['name'];
				vStaffListData::UploadPhoto($this->post->id, $file_name);
			}
			else {
                return false;
            }
		}
		else {return false;}

	}
	
	protected function remove_image_post($id)
	{
		if($id == '')
		{
			return false;	
		}
		$staff = vStaffListData::getStaff($id);
		$ret = vStaffListData::RemovePhoto($id);
		unlink(SITE_ROOT.'staff_photos/'.$staff->picturelink);
	}
	
	protected function delete_staff_post($id)
	{
		if($id == '')
		{
			$this->set('message', 'Can not delete staff! - No Staff ID Passed!');
			$this->render('core_error.tpl');
			return false;	
		}
		
		$staff = vStaffListData::getStaff($id);
		$ret = vStaffListData::RemovePhoto($id);
		if(file_exists(SITE_ROOT.'staff_photos/'.$staff->picturelink))
		{
			unlink(SITE_ROOT.'staff_photos/'.$staff->picturelink);
		}
		
		vStaffListData::DeleteStaff($id);
	}

	protected function add_staff_cat_post()
	{
		if($this->post->name == "")
		{
			$this->set('message', 'Please enter the category name!');
			$this->render('core_error.tpl');
			return false;
		}
		
		$ret = vStaffListData::AddCategory($this->post->name, $this->post->order);
	}
	
	protected function edit_staff_cat_post()
	{
		if($this->post->name == "")
		{
			$this->set('message', 'Please enter the category name!');
			$this->render('core_error.tpl');
			return false;
		}
		
		$ret = vStaffListData::UpdateCategory($this->post->id, $this->post->name, $this->post->order);
	}

	protected function delete_staff_cat_post()
	{
		$check = vStaffListData::GetAllStaffInCat($this->post->id);
		if($check)
		{
			$this->set('message', 'There are currently staff members under the category, you must remove them from the category before deleting the category!');
			$this->render('core_error.tpl');
			return false;
		}
		
		$ret = vStaffListData::DeleteCategory($this->post->id);
	}
}