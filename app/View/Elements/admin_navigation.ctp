<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand animate-logo" style="color: #ffffff;" href="http://www.thetadesigns.com">Theta
                Designs CMS</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown <?php echo (!empty($this->params['controller']) && ($this->params['controller'] == 'users' || $this->params['controller'] == 'roles' || $this->params['controller'] == 'profiles' || $this->params['controller'] == 'settings')) ? 'active' : 'inactive'; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">System <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><?php echo $this->Html->link('Settings', array('controller' => 'settings', 'action' => 'index')); ?></li>
                        <li class="divider"></li>
                        <li><?php echo $this->Html->link('Invite Admin', array('controller' => 'users', 'action' => 'invite', 'admin')); ?></li>
                    <?php if(isset($user_role_id) && $user_role_id==3): ?>
                        <li><?php echo $this->Html->link('Invite Webmaster', array('controller' => 'users', 'action' => 'invite', 'webmaster')); ?></li>
                        <li class="divider"></li>
                        <li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
                        <li><?php echo $this->Html->link('Roles', array('controller' => 'roles', 'action' => 'index')); ?></li>
                        <li><?php echo $this->Html->link('Profiles', array('controller' => 'profiles', 'action' => 'index')); ?></li>
                    <?php endif; ?>
                    </ul>
                </li>
                <li class="<?php echo (!empty($this->params['controller']) && ($this->params['controller']=='home')) ? 'active' :'inactive'; ?>">
                    <?php echo $this->Html->link('Home', array('controller' => 'home', 'action' => 'index')); ?>
                </li>
                <li>
                    <a href="#about">About</a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
            </ul>
        <?php if($user_loggedIn): ?>
            <ul class="nav navbar-nav navbar-right">
                <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
            </ul>
        <?php endif; ?>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>