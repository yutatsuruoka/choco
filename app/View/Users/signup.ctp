<?php
//
// views/users/signup.ctp
//
echo $this->Form->create('User', array('action' => 'signup'));

// As you can see I defined error messages in the view files instead of the User model.
// I consider error messages as view logic. This way, everything that renders in the
// view is in one place.
echo $this->Form->input('name', array(
    'label' => __('Name', true),
    'error' => array(
        // here the key 'user-not-empty-rule' corresponds with the same key we defined in the User model
        // If the notEmpty rule for the 'name' in the User model returns false
        // this error message is shown
        'name-not-empty-rule' => __("Your name cannot be empty", true)
    )
));

echo $this->Form->input('email', array(
    'type' => 'email',
    'error' => array(
        'email' => __("This is not a valid email address", true),
        'isUnique' => __("There is already an account registered under this email address", true),
        'notEmpty' => __("You must fill in an email address", true)
    )
));

echo $this->Form->input('password', array(
    'error' => array(
        'notEmpty' => __("You must fill in a password", true),
        'minLength' => __("A password must be at least 5 characters long", true)
    )
));

echo $this->Form->end(__('Sign up', true));
?>