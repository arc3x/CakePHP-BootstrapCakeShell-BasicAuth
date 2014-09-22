<div class="row visible-lg" style="padding-top: 60px;"></div>

<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <h4 style="border-bottom: 1px solid #c5c5c5;">
            <i class="glyphicon glyphicon-user">
            </i>
            Account Creation
        </h4>

        <div style="padding: 20px;" id="form-olvidado">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
            <fieldset>
                <?php if(isset($token)): ?>
                    <input type="hidden" name="data[User][token]" value="<?php echo $token; ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'Email', 'type' => 'email', 'label' => false));?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Display Name', 'label' => false));?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('password', array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password', 'label' => false));?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_repeat" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('password_repeat', array('class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password Repeat', 'label' => false));?>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Create Account
                    </button>
                </div>
            </fieldset>
            <?php $this->Form->end(); ?>
        </div>
    </div>
</div>