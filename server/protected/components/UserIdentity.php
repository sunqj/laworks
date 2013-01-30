<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    static private $DEV_PASSWORD = "dev";

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * 
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $username = strtolower ($this->username);
        if($this->username == 'dev' && $this->password == 'linuxred')
        {
            $this->setState('permission_id', 5);
            $this->_id = -1;
            $this->errorCode = self::ERROR_NONE;
            return !$this->errorCode;
        }
        
        $user = User::model ()->find ('LOWER(username)=?',array($username));
    
        if ($user == null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif ($user->password != $this->password)
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            if($user->permission_id > 2)
            {
                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
            }
            else
            {
                $this->_id = $user->user_id;
                $this->username = $user->username;

                $this->setState('permission_id', $user->permission_id);
                $this->setState('enterprise_id', $user->enterprise_id);
                
                $this->errorCode = self::ERROR_NONE;
            }
        }
        
        return !$this->errorCode;
    }
    
    public function getId()
    {
        return $this->_id;
    }
    
}