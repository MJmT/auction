	
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/Abstract.php');
class User extends AbstractLoginClass {
	

	public function __construct() {
		
		AbstractLoginClass::__construct();
		if(isset($_POST['setup']))
			$this->SetupFirstStep();
		else if(isset($_POST['setup2']))
			$this->SetupSecondStep();
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

					if($this->ChangeEmailId() == true && $this->EmailIdExists() == true) {
							$this->errors[] = "The email id is already taken";
							
						}
						
					else{
						 if($this->ChangeEmailId() && !$this->EmailIdExists()) 
						    $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
						else 
							$user_email = $_SESSION['user_email'];
					
						$user_fname = $this->db_connection->real_escape_string(strip_tags($_POST['user_fname'], ENT_QUOTES));
						$user_lname = $this->db_connection->real_escape_string(strip_tags($_POST['user_lname'], ENT_QUOTES));
						$user_mobile = (int) $_POST['user_mobile'];
						$sql = "UPDATE  users 
								SET user_email='" . $user_email . "', user_fname='" . $user_fname . "', user_lname='" . $user_lname . "', user_mobile='" .$user_mobile. "' 
								WHERE user_name = '" . $_SESSION['user_name']. "';";

						$result_from_update = $this->db_connection->query($sql);
						if($result_from_update) {

							$this->messages[] = "Success!";
							include('views/profile_setup2.php');
							exit();
						}
						else 
							$this->errors[] = "Failed to update the database";
				}
			}
			else 
				$this->errors[] = "The database connection failed";
			
		}
		else {
            if(empty($this->errors)) 
                $this->errors[] = "An unknown error occurred." . $this->db_connection->error;
        }
    }

    private function SetupSecondStep() {
    	if($this->AddressCheck() && $this->CityCheck() && $this->StateCheck() && $this->CountryCheck())  {
    		if($this->setupDbConnection()==true) {
    			
    			$address1 = $this->db_connection->real_escape_string(strip_tags($_POST['address1'], ENT_QUOTES));
    			$address2 = $this->db_connection->real_escape_string(strip_tags($_POST['address2'], ENT_QUOTES));
    			$address3 = $this->db_connection->real_escape_string(strip_tags($_POST['address3'], ENT_QUOTES));
    			$city= $this->db_connection->real_escape_string(strip_tags($_POST['city'], ENT_QUOTES));
    			$state= $this->db_connection->real_escape_string(strip_tags($_POST['state'], ENT_QUOTES));
    			$country= $this->db_connection->real_escape_string(strip_tags($_POST['country'], ENT_QUOTES));
    			$sql = "INSERT INTO address (user_name,address1,address2,address3,city,state,country) 
    					VALUES('" . $_SESSION['user_name'] . "','" . $address1 . "','" . $address2 . "','" . $address3 . "','" . $city . "','" . $state . "','" . $country ."');";
    				$result_from_insert = $this->db_connection->query($sql);
    				
    				if($result_from_insert) {
    						
    							$sql = "UPDATE  users 
								SET user_profile_status=1 WHERE user_name = '" . $_SESSION['user_name']. "';";
								$result_from_update = $this->db_connection->query($sql);
								if($result_from_update) {
									$this->messages[] = "Success!";
									include('views/profile_setup3.php');
									exit();
							
								}
							}
						else 
							$this->errors[] = "Failed to update the database";
					}
			
			else 
				$this->errors[] = "The database connection failed";
			
			}
		else {
            if(empty($this->errors)) 
                $this->errors[] = "An unknown error occurred." . $this->db_connection->error;
        }
    }
						
}
