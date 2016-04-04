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

     public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();
      

    }
     public function clickAction($action) {
        if(isset($_GET[$action])) {
            $admin_action= array("user_accounts","products","categories","static_pages","customer_query");
            $arrlength = count($admin_action);
            for($i=0;$i<=$arrlength;$i++) {
                    if(strcmp($action,$admin_action[$i])==0) {
                            return $action;
                    }
                    
            }
        }

       
        else if(empty($_GET)) {
            return "admin_panel";
        }
    }
    
    public function ShowUserAccounts() {

       $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


            // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
           }

          // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT user_id, user_name, user_email, user_privilege
                    FROM users";
            return $result_user_table = $this->db_connection->query($sql);

        }
    }

    public function isAdmin($privilege) {
            if($privilege==100)
                return true;
        }
}?>