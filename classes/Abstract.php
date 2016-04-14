<?php

class AbstractLoginClass {
	/*
	   * @var array Collection of error messages
     */
	protected $db_connection = NULL;
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();



	public function __construct() {
		  // create/read session, absolutely necessary
        session_start();

    }

      //THese functions are constraint checks for user registration and profile updation
    protected function UsernameCheck() {
        if (empty($_POST['user_name'])) 
            $this->errors[] = "Empty Username";
        elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) 
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) 
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        else return true;
     }
     protected function PasswordCheck() {
        if (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat']))
            $this->errors[] = "Empty Password";
        elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) 
            $this->errors[] = "Password and password repeat are not the same";
        elseif (strlen($_POST['user_password_new']) < 6) 
            $this->errors[] = "Password has a minimum length of 6 characters";
        else return true;
     }
     protected function EmailCheck() {
        if (empty($_POST['user_email'])) 
            $this->errors[] = "Email cannot be empty";
        elseif (strlen($_POST['user_email']) > 64) 
            $this->errors[] = "Email cannot be longer than 64 characters";
        elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) 
            $this->errors[] = "Your email address is not in a valid email format";
        else return true;
	}
    
      protected function NameCheck() {
      	if(empty($_POST['user_fname'] OR empty($_POST['user_lname']))) 
      		$this->errors[] = "Name field cannot be left blank";
      	 elseif (!preg_match('/^[a-zA-Z ]*$/i', $_POST['user_fname']) OR !preg_match('/^[a-zA-Z ]*$/i', $_POST['user_lname'])) 
      	 	$this->errors[] = "Name cannot contain special characters or numbers";
      	 else return true;
      	 
      	
      }

      protected function MobileNumberCheck() {
      	if (empty($_POST['user_mobile'])) 
            $this->errors[] = "Mobile Number cannot be empty";
        else if(!preg_match('/^\d{10}$/',$_POST['user_mobile']) OR !is_numeric($_POST['user_mobile'])) 
        	$this->errors[] = "Mobile number entered doesn't exist";
        else return true;
        
      }

      protected function AddressCheck() {
        if(empty($_POST['address1'])) 
            $this->errors[] = "Please enter your address.";
          else return true;

      }
 
    protected function CityCheck() {
       if(empty($_POST['city']))
          $this->errors[] = "The city field is empty.";
        else return true;
    }

     protected function StateCheck() {
       if(empty($_POST['state']))
          $this->errors[] = "The STate field is empty.";
        else return true;

    }

    protected function CountryCheck() {
       if(empty($_POST['Country']))
          $this->errors[] = "The country field is empty.";
        elseif(!strcmp($_POST['country'],'India')==0)
          $this->errors[] = "Sorry, we do not ship outside India at the moment";
        else return true;

    }
    

    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }

    /** returns whether the current user is admin or not
    * @return boolean user's admin status 
    */

    public function isUserAdmin() {
            if($_SESSION['user_privilege'] == 100 ) {
                    return true;
                }

                return false;
            }   
    

    protected function setupDbConnection() {

    // create a database connection, using the constants from config/db.php (which we loaded in index.php)
    $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


            // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
           }

          // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno)
        	return true;
        else
        	return false;
    }
    protected function ChangeEmailId() {
    	if(strcmp($_SESSION['user_email'], $_POST['user_email']) != 0) {
						  return true;
      }
    }
    protected function EmailIdExists() {
    	$user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
		$sql = "SELECT * FROM users WHERE user_email='" .  $user_email . "';";
		$query_check_user_email = $this->db_connection->query($sql);
		if($query_check_user_email->num_rows ==1) 
		   return true;
		/*else {
			$sql = "UPDATE users 
					SET user_email='" . $user_email . "',  
					WHERE user_name='" . $_SESSION['user_name'] . "';";
			  $query_email_update = $this->db_connection->query($sql);
				
			}*/
	}		
 }