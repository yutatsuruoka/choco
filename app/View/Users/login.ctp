<div class="SNS Login">
<p><?php echo $this->Html->link('Login via Twitter', array('action' => 'twitter')); ?></p>
<!-- <p><?php echo $this->Html->link('Login via Facebook', array('action' => 'facebook')); ?></p> -->
<p><?php echo $this->Html->link('Signup', array('action' => 'signup')); ?></p>
</div>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>Username/Password</legend>
        <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login', true)); ?>
    <?php echo $this->Form->postButton("Login via Twitter", '/users/twitter'); ?>
</div>

