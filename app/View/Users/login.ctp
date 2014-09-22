<div class="row visible-lg" style="padding-top: 60px;"></div>

<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <h4 style="border-bottom: 1px solid #c5c5c5;">
            <i class="glyphicon glyphicon-user">
            </i>
            Account Access
        </h4>

        <div style="padding: 20px;">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        @
                    </span>
                    <input id="login_email" class="form-control" placeholder="Email" name="data[User][email]" type="email" required="" autofocus="">
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-lock"></i>
                    </span>
                    <input id="login_password" class="form-control" placeholder="Password" name="data[User][password]" type="password" value="" required="">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Access
                    </button>
                    <p class="help-block">
                        <a class="pull-right text-muted" href="<?php echo Router::url(array('controller' => 'users', 'action' => 'forgotPassword')); ?>">
                            <small>Forgot your password?</small>
                        </a>
                    </p>
                </div>
            </fieldset>
            <?php $this->Form->end(); ?>
        </div>
    </div>
</div>

