<div class="row visible-lg" style="padding-top: 60px;"></div>

<div class="row">
    <div class="col-md-6 col-md-offset-3">


        <div class="panel panel-info">
            <div class="panel-heading">
                <?php if (isset($user['User']['username'])): ?>
                    <h3 class="panel-title"><?php echo $user['User']['username'].' ('.$user['User']['email'].')'; ?></h3>
                <?php else: ?>
                    <h3 class="panel-title"><?php echo $user['User']['email']; ?></h3>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <?php echo $this->Form->create('User.Profile' , array('role' => 'form')); echo $this->Form->input('id', array('value' => $user['Profile']['id'])); ?>
                    <?php if(isset($user['Profile']['thumbnail_picture']) && !empty($user['Profile']['thumbnail_picture'])): ?>
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo $user['Profile']['thumbnail_picture']; ?>" class="img-circle"> </div>
                    <?php else: ?>
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                    <?php endif; ?>

                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                                <tr>
                                    <th>Full Name</th>
                                    <td class="profile-view">
                                        <?php
                                            if(isset($user['Profile']['full_name'])) {
                                                echo $user['Profile']['full_name'];
                                            }
                                        ?>
                                    </td>
                                    <td class="profile-edit">
                                        <?php
                                            if(isset($user['Profile']['full_name']))
                                                echo $this->Form->input('full_name', array('class' => 'form-control', 'placeholder' => 'Full Name', 'value' => $user['Profile']['full_name'], 'type' => 'text', 'label' => false));
                                            else
                                                echo $this->Form->input('full_name', array('class' => 'form-control', 'placeholder' => 'Full Name', 'type' => 'text', 'label' => false));
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <th>About Me</th>
                                    <td class="profile-view text-justify"><p>
                                        <?php
                                        if(isset($user['Profile']['bio'])) {
                                            echo $user['Profile']['bio'];
                                        }
                                        ?>
                                    </p></td>
                                    <td class="profile-edit">
                                        <?php
                                        if(isset($user['Profile']['bio']))
                                            echo $this->Form->input('bio', array('class' => 'form-control', 'placeholder' => 'About Me', 'value' => $user['Profile']['bio'], 'type' => 'textarea', 'label' => false));
                                        else
                                            echo $this->Form->input('bio', array('class' => 'form-control', 'placeholder' => 'About Me', 'type' => 'textarea', 'label' => false));
                                        ?>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                        <button id="save-profile" class="profile-edit btn btn-primary pull-right">Save Profile</button>
                        <button id="edit-profile" class="profile-view btn btn-primary pull-right">Edit Profile</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.profile-edit').hide();
        $('#edit-profile').click(function(e) {
            e.preventDefault();
            $('.profile-view').toggle();
            $('.profile-edit').toggle();
        });
        $('#save-profile').click(function(e) {
            e.preventDefault();
            $('#ProfileProfileForm').submit();
        });
    });
</script>