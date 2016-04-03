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
                if(strcmp($action,"user_accounts")==0) {
                    return "user_accounts";
                }
                else if(strcmp($action,"products")==0) {
                    return "products";
                }
                else if(strcmp($action,"user_accounts")==0) {
                    return "user_accounts";
                }
                else if(strcmp($action,"categories")==0) {
                    return "categories";
                }
                else if(strcmp($action,"static_pages")==0) {
                    return "static_pages";
                }
                else if(strcmp($action,"customer_query")==0) {
                    return "customer_query";
                }
                
                
        }
        else if(empty($_GET)) {
            return "home";
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