<?php

/**
 * class Login * 
 * handles the user login/logout/session
 * 
 * @author Panique <panique@web.de>
 * @version 1.1
 */
class Login {

    private     $connection                 = null;                     // database connection   
    
    private     $user_name                  = "";                       // user's name
    private     $user_email                 = "";                       // user's email
    private     $user_password              = "";                       // user's password (what comes from POST)
    private     $user_password_hash         = "";                       // user's hashed and salted password
	private     $user_role		            = "";
    private     $user_is_logged_in          = false;                    // status of login
    
    public      $registration_successful    = false;
    
    public      $view_user_name           = "";
    public      $view_user_email          = "";

    public      $errors                     = array();                  // collection of error messages
    public      $messages                   = array();                  // collection of success / neutral messages
    
    
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */    
    public function __construct(Database $db) {                     // (Database $db) says: the _construct method expects a parameter, but it has to be an object of the class "Database"
        
        $this->connection = $db->getDatabaseConnection();                   // get the database connection
        
        if ($this->connection) {                                            // check for database connection
            
            session_start();                                        // create/read session
            
            if (isset($_GET["logout"])) {
                
                $this->doLogout();
                            
            } elseif (!empty($_SESSION['user_name']) && ($_SESSION['user_logged_in'] == 1)) {
                
                $this->loginWithSessionData();                
                
            } elseif (isset($_POST["login"])) {
                
                if (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
                    
                    $this->loginWithPostData();
                
                } elseif (empty($_POST['user_name'])) {
                    
                    $this->errors[] = "Username field was empty.";
                    
                } elseif (empty($_POST['user_password'])) {
                    
                    $this->errors[] = "Password field was empty.";
                    
                }
                
            }
            
        } else {
            
            $this->errors[] = "No MySQL connection.";
        }
        
        // cookie handling user name
        if (isset($_COOKIE['user_name'])) {
            $this->view_user_name = strip_tags($_COOKIE["user_name"]);
        } else {
            $this->view_user_name = "Username";
        }
        
        // cookie handling avatar link
        if (isset($_COOKIE['user_email'])) {
            $this->avatar_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($_COOKIE['user_email']))) . "?d=mm&s=125";
        } else {
            // override 
            $this->avatar_url = "http://www.gravatar.com/avatar/" . md5("xxxxxx@xxxxxxxxxx.com") . "?d=mm&s=125";
        }
        
    }    
    

    private function loginWithSessionData() {
        
        $this->user_is_logged_in = true;
        
    }
    

    private function loginWithPostData() {
            
            $this->user_name = $this->connection->real_escape_string($_POST['user_name']);            
            $checklogin = $this->connection->query("SELECT user_name, user_email, user_password_hash, user_role FROM users WHERE user_name = '".$this->user_name."';");
            
            if($checklogin->num_rows == 1) {
                
                $result_row = $checklogin->fetch_object();
                
                if (crypt($_POST['user_password'], $result_row->user_password_hash) == $result_row->user_password_hash) {
                    
                    /**
                     *  write user data into PHP SESSION [a file on your server]
                     */
                    $_SESSION['user_name'] = $result_row->user_name;
                    $_SESSION['user_email'] = $result_row->user_email;
                    $_SESSION['user_role'] = $result_row->user_role;
                    $_SESSION['user_logged_in'] = 1;
                    
                    /**
                     *  write user data into COOKIE [a file in user's browser]
                     */
                    setcookie("user_name", $result_row->user_name, time() + (3600*24*100));
                    setcookie("user_email", $result_row->user_email, time() + (3600*24*100));
                    setcookie("user_role", $result_row->user_email, time() + (3600*24*100));
                    
                    $this->user_is_logged_in = true;
                    return true;          
                    
                } else {
                    
                    $this->errors[] = "Wrong password. Try again.";
                    return false;  
                    
                }                
                
            } else {
                
                $this->errors[] = "This user does not exist.";
                return false;
            }        
    }
    
    
    public function doLogout() {
        
            $_SESSION = array();
            session_destroy();
            $this->user_is_logged_in = false;
            $this->messages[] = "You have been logged out.";
    }
    
    
    public function isUserLoggedIn() {
        
        return $this->user_is_logged_in;
        
    }
}