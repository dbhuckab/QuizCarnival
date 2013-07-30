<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quizusers_m extends MY_Model {

	public function __construct()
	{		
            parent::__construct();
            $this->set_dbprefix('');
            $this->primary_key = "idUser";
            /**
             * If the sample module's table was named "samples"
             * then MY_Model would find it automatically. Since
             * I named it "sample" then we just set the name here.
             */
            $this->_table = 'qc_user';
	}
	
	//create a new item
	public function create($input)
	{
            // Before creating, check if all valid:
            if(!$this->_check_account_new_insert($input))
                return FALSE;
            
            // Get desired default values
            $balance      = 0; // Starting tokens and balance, unless defined in db
            $tokens       = 0;
            $accountLevel = 1; // Standard carnival attendee...
            
            $query = $this->db->get_where('qc_settings', array('settingsKey' => "newAccountBalance"), 1, 0);
            if($query->num_rows())
                $balance = $query->row()->settingsKey;
            
            $query = $this->db->get_where('qc_settings', array('settingsKey' => "newAccountTokens"), 1, 0);
            if($query->num_rows())
                $tokens = $query->row()->settingsKey;
            
            $query = $this->db->get_where('qc_settings', array('settingsKey' => "newAccountStartingLevel"), 1, 0);
            if($query->num_rows())
                $accountLevel = $query->row()->settingsKey;
            
            $to_insert = array(
                "email"                       => $input['email'],
                "username"                    => $input['username'],
                "firstName"                   => $input['firstName'],
                "lastName"                    => $input['lastName'],
                "facebookId"                  => $input['facebookId'],
                "password"                    => md5($input['password']),
                "balance"                     => $balance,
                "tokens"                      => $tokens,
                "AccountLevel_idAccountLevel" => $accountLevel,
                "isSystemUser"                => 0,
                "is_deleted"                  => 0,
                "delete_reason"               => 0,
                "dateJoined"                  => date("Y-m-d H:i:s"),
                "lastLogin"                   => date("Y-m-d H:i:s")
            );
            
            return $this->db->insert('qc_user', $to_insert);
	}
        
        public function _check_account_new_insert($input) {
            $email      = (isset($input['email'])) ? trim($input['email']) : "";
            $username   = (isset($input['username'])) ? trim($input['username']) : "";
            $password   = (isset($input['password'])) ? trim($input['password']) : "";
            $facebookId = (isset($input['facebookId'])) ? trim($input['facebookId']) : "";
            
            // User has to have at least email, username, OR facebookId at minimum
            if(empty($email) && empty($username) && empty($facebookId))
                return FALSE;
            
            // If no Facebook id... MUST have password
            if(empty($facebookId) && empty($password))
                return FALSE;
            
            // Now check for duplicate values in database
            $row = $this->get_by("email", $email);
            if($row)
                return FALSE;
            $row = $this->get_by("username", $username);
            if($row)
                return FALSE;
            $row = $this->get_by("password", $password);
            if($row)
                return FALSE;
            
            return TRUE;
        }

}
