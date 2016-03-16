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
}
?>