<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    /**
     * Authentication
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {

        $record = User::model()->findByAttributes(array('login' => $this->username));

        if ($record === null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (!CPasswordHelper::verifyPassword($this->password, $record->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->setState('role_id', $record->role_id);
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

}
