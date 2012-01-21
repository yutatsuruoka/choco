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
                , 'scope' => array('User.deleted' => null
                    , 'User.type' => 0)
            ), 'Form'
        );

        // store a reference to the current user
        $this->current_user = $this->Auth->user();
    }

    function beforeRender() {
        // Make the current_user variable available in all of our views
        // For example, in your view you can reach the current user's
        // email address as follows: echo $current_user['email'];
        $this->set('current_user', $this->current_user );
    }    
}