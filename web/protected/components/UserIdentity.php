<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $_enterprise_id;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $username = strtolower($this->username);
        print_r($this->username);
        $user = User::model()->find('LOWER(username)=?', array($username));
        
        print_r($user->password);
        if($user === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif ($user->password != $this->password)
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->user_id;
            $this->setState("enterprise_id", $user->enterprise_id); 
            $this->username = $user->username;
        }
        
        return !$this->errorCode;
    }
    
    public function getId()
    {
    	return $this->_id;
    }
    
    public function getEnterpriseId()
    {
        return $this->_enterprise_id;
    }
}
