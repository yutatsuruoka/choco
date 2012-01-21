<?php
class User extends AppModel {

    public $name = 'User';

    public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'allowEmpty' => FALSE,
                'message' => 'Please insert a username'
            ),
            'check_user' => array(
                'rule' => 'check_user',
                'message' => 'Either your Username or Password is invalid',
                'last' => TRUE
            ),
            'check_username_exists' => array(
                'rule' => 'check_username_exists',
                'message' => 'Username already exists, please choose another',
            ),
        ),
        'password' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'allowEmpty' => FALSE,
                'message' => 'Please insert a password'
            )
        )
    );

    /**
     * Private User
     * @var array
     */
    var $_user = array();

    /**
     * Check a User is valid
     * @param array $check
     * @return bool
     */
    function check_user($check) {
        // only check if Username & Password are present
        if (!empty($check['username']) 
                && !empty($_POST['data']['User']['password'])) {
            // get User by username
            $user = $this->find('first', array('conditions' => 
                array('User.username' => $check['username'])));

            // invalid User
            if (empty($user)) {
                return FALSE;
            }

            // compare passwords
           if ($user['User']['password'] 
                    != AuthComponent::password($_POST['data']['User']['password'])) {
                return FALSE;
            }

            // save User
            $this->_user = $user;
        }

        return TRUE;
    }

    /**
     * Check a username exists in the database
     * @param array $check
     * @return bool
     */
    function check_username_exists($check) {
        // get User by username
        if (!empty($check['username'])) {
            $user = $this->find('first', array('conditions' 
                => array('User.username' => $check['username'])));

            // invalid User
            if (!empty($user)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * BeforeSave Callback
     */
    function beforeSave() {
        // hash Password
        if (!empty($this->data['User']['password'])) {
            $this->data['User']['password'] = 
                    AuthComponent::password($this->data['User']['password']);
        } else {
            // remove Password to prevent overwriting empty value
            unset($this->data['User']['password']);
        }

        return TRUE;
    }

}

?>
