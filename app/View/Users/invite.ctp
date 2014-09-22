<div class="row visible-lg" style="padding-top: 60px;"></div>

<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <h4 style="border-bottom: 1px solid #c5c5c5;">
            <i class="glyphicon glyphicon-user">
            </i>
            Account Invitation
        </h4>

        <div style="padding: 20px; padding-top: 0px;">
            <?php echo $this->Form->create('User', array('onsubmit'=>'return confirm("Are you sure you want to invite: "+$("#invite_email").val()+"?\n\n(as an '.$this->request->params['pass'][0].')");')); ?>
            <fieldset>
                    <span class="help-block">
                        Email address you use to log in to your account
                        <br>
                        We'll send an email with instructions to create an account.
                    </span>

                <div class="form-group input-group">
                        <span class="input-group-addon">
                            @
                        </span>
                    <input id="invite_email" class="form-control" placeholder="Email" name="data[User][email]" type="email" required="required">
                </div>
                <button id="invite_submit" type="submit" class="btn btn-primary btn-block">
                    Send
                </button>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>