	
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/Abstract.php');
class User extends AbstractLoginClass {

	public function __construct() {
		
		AbstractLoginClass::__construct();
		if(isset($_POST['setup']))
			$this->SetupFirstStep();
	}

	
	public function isProfileComplete($user) {
		if($this->setupDbConnection()==true) {
			 $sql = "SELECT user_profile_status 
			 		 FROM users WHERE user_name='" . $user . "';";
			 $result_profile_status = $this->db_connection->query($sql);
			 $result_object = $result_profile_status->fetch_object();
			 if($result_object->user_profile_status==1)
			 		return true;
			 else
			 		return false;
		} 

	}
	private function SetupFirstSTep() {
		if( $this->EmailCheck() && $this->NameCheck() && $this->MobileNumberCheck()) {
				if($this->setupDbConnection()==true) {
					if($this->ChangeEmailId() == true) {
						 if($this->EmailIdExists() == true) 
							$this->errors[] = "The email id is already taken";
						  else 
						  	$user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
						}

					$user_fname = $this->db_connection->real_escape_string(strip_tags($_POST['user_fname'], ENT_QUOTES));
					$user_lname = $this->db_connection->real_escape_string(strip_tags($_POST['user_lname'], ENT_QUOTES));
					$sql = "UPDATE  users"
				}
		}
	}
}