<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

class AppController extends Controller {
    var $helpers = array('Html', 'Form', 'Facebook.Facebook');
    var $components = array('Session', 'Auth', 'Facebook.Connect');

    var $current_user = false;
    
    var $logger = null;
    
    function beforeFilter()
    {
        // Specify which controller/action handles logging in:
        $this->Auth->loginAction = array('controller' => 'users', 
            'action' => 'login');
        
        // Where to redirect to after successfully logging in:
        // This can also be an array() with 'controller' and 'action' keys like above.
        $this->Auth->loginRedirect = '/';
        // Where to redirect to after successfully logging out:
        $this->Auth->logoutRedirect = '/';

        // By default, the Auth component expects a username and a password
        // columns in the User table. But we would like to override those defaults
        // and use the email column instead of the username column.
        $this->Auth->authenticate = array(
            AuthComponent::ALL => array(
                'fields' => array(
                    'username' => 'email'
                    , 'password' => 'password')
                , 'userModel' => 'User'
                , 'scope' => array('User.deleted' => null)
            ), 'Form'
        );

        // store a reference to the current user
        $this->current_user = $this->Auth->user();
        
        //Application ロギング
        require_once APP.'Vendor/PEAR/Log.php';    
        $log_level = PEAR_LOG_INFO;
        switch(LOG_LEVEL){
                        case 'EMERG':     /* System is unusable */
                                $log_level = PEAR_LOG_EMERG;
                                break; 
                        case 'ALERT':     /* Immediate action required */
                                $log_level = PEAR_LOG_ALERT;
                                break; 
                        case 'CRIT':     /* Critical conditions */
                                $log_level = PEAR_LOG_CRIT;
                                break; 
                        case 'ERR':     /* Error conditions */
                                $log_level = PEAR_LOG_ERR;
                                break; 
                        case 'WARNING':     /* Warning conditions */
                                $log_level = PEAR_LOG_WARNING;
                                break; 
                        case 'NOTICE':     /* Normal but significant */
                                $log_level = PEAR_LOG_NOTICE;
                                break; 
                        case 'INFO':     /* Informational */
                                $log_level = PEAR_LOG_INFO;
                                break; 
                        case 'DEBUG':     /* Debug-level messages */
                                $log_level = PEAR_LOG_DEBUG;
                                break; 
                        case 'ALL':    /* All messages */
                                $log_level = PEAR_LOG_ALL;
                                break; 
                        case 'NONE':    /* No message */
                                $log_level = PEAR_LOG_NONE;
                                break; 
        }

        $this->logger = &Log::factory(LOG_OUTPUT,LOG_FILE, 'APP',null,$log_level);
    }

    function beforeRender() {
        // Make the current_user variable available in all of our views
        // For example, in your view you can reach the current user's
        // email address as follows: echo $current_user['email'];
        $this->set('current_user', $this->current_user );
    }    
    
    function currentURL(){
    	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
	      || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
	    ) {
            $protocol = 'https://';
            $https = true;
        }
        else {
            $protocol = 'http://';
            $https = false;
        }
            
        return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];    	
    }
}
