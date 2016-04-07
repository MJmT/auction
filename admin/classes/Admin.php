<?php

/* Class admin
* handles the administrator view
*/
require_once($_SERVER['DOCUMENT_ROOT'] . '/pro2/classes/Abstract.php');
class Admin extends AbstractLoginClass  {

	
     
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

       if($this->setupDbConnection()==true)
       {
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