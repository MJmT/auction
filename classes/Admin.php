<?php

/* Class admin
* handles the administrator view
*/

class Admin  {

	/**
     * @var object The database connection
     */
	private $db_connection = NULL;
	/**
     * @var array Collection of error messages
     */
	public $errors= array();
	 /**
     * @var array Collection of success / neutral messages
     */
     public $messages = array();

     public function __construct() {
        // create/read session, absolutely necessary
        session_start();

       /**if a privileged user tries to access the features from the admin panel, 
       then  the following methods get called.
       */
		if(isset($_GET['user_account'])) {
			$this->ManageUserAccounts();

		 }     
	  }

	  private function ManageUserAccounts() {
	  		header(Location:"views/user-accounts.php");
	  }


      
}
?>