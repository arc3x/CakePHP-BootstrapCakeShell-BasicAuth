<div class="row visible-lg" style="padding-top: 60px;"></div>

<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <h4 style="border-bottom: 1px solid #c5c5c5;">
            <i class="glyphicon glyphicon-user">
            </i>
            Account Recovery
        </h4>

        <div style="padding: 20px; padding-top: 0px;">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('action' => 'sendRecovery')); ?>
                <fieldset>
                    <span class="help-block">
                        Email address you use to log in to your account
                        <br>
                        We'll send you an email with instructions to choose a new password.
                    </span>

                    <div class="form-group input-group">
                        <span class="input-group-addon">
                            @
                        </span>
                        <input id="recovery_email" class="form-control" placeholder="Email" name="data[User][email]" type="email">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="btn-olvidado">
                        Continue
                    </button>
                    <p class="help-block">
                        <a class="text-muted" href="<?php echo Router::url(array('controller' => 'users', 'action' => 'login')); ?>">
                            <small>Account Access</small>
                        </a>
                    </p>
                </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>