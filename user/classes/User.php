	
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

					/*if($this->ChangeEmailId() == true) {
						 if($this->EmailIdExists() == true) {
							$this->errors[] = "The email id is already taken";
							include('views/profile_setup.php');
							exit();
						}
						}
						  else */
						  	$user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
						}
						else $user_email = $_SESSION['user_email'];

					$user_fname = $this->db_connection->real_escape_string(strip_tags($_POST['user_fname'], ENT_QUOTES));
					$user_lname = $this->db_connection->real_escape_string(strip_tags($_POST['user_lname'], ENT_QUOTES));
					$user_mobile = (int) $_POST['user_mobile'];
					$sql = "UPDATE  users 
							SET user_email='" . $user_email . "', user_fname='" . $user_fname . "', user_lname='" . $user_lname . "' 
							WHERE user_name = '" . $_SESSION['user_name']. "';";

					$result_from_update = $this->db_connection->query($sql);
						if($result_from_update) {
							$this->messages[] = "Success!";
						}
						else 
							$this->errors[] = "Something Went wrong";
				}
		}
	}
//}