<div class="users view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('User'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit User'), array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete User'), array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<?php if(!empty($user['User']['id'])): ?>
<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['active'])): ?>
<tr>
		<th><?php echo __('Active'); ?></th>
		<td>
			<?php echo h($user['User']['active']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['role_id'])): ?>
<tr>
		<th><?php echo __('Role'); ?></th>
		<td>
			<?php echo $this->Html->link($user['Role']['name'], array('controller' => 'roles', 'action' => 'view', $user['Role']['id'])); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['username'])): ?>
<tr>
		<th><?php echo __('Username'); ?></th>
		<td>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['password'])): ?>
<tr>
		<th><?php echo __('Password'); ?></th>
		<td>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['email'])): ?>
<tr>
		<th><?php echo __('Email'); ?></th>
		<td>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['created'])): ?>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($user['User']['modified'])): ?>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

	<div class="row related">
		<div class="col-md-12">
			<h3><?php echo __('Related Profiles'); ?></h3>
			<table class="table table-striped">
			<tbody>
		<?php if (!empty($user['Profile'])): ?>
			<tr>
				<th><?php echo __('Id'); ?></th>
		<td>
	<?php echo $user['Profile']['id']; ?>
&nbsp;</td>
		<th><?php echo __('User Id'); ?></th>
		<td>
	<?php echo $user['Profile']['user_id']; ?>
&nbsp;</td>
		<th><?php echo __('Full Name'); ?></th>
		<td>
	<?php echo $user['Profile']['full_name']; ?>
&nbsp;</td>
		<th><?php echo __('Picture'); ?></th>
		<td>
	<?php echo $user['Profile']['picture']; ?>
&nbsp;</td>
		<th><?php echo __('Thumbnail Picture'); ?></th>
		<td>
	<?php echo $user['Profile']['thumbnail_picture']; ?>
&nbsp;</td>
		<th><?php echo __('Bio'); ?></th>
		<td>
	<?php echo $user['Profile']['bio']; ?>
&nbsp;</td>
		<th><?php echo __('Created'); ?></th>
		<td>
	<?php echo $user['Profile']['created']; ?>
&nbsp;</td>
		<th><?php echo __('Modified'); ?></th>
		<td>
	<?php echo $user['Profile']['modified']; ?>
&nbsp;</td>
			</tr>
		<?php endif; ?>
			</tbody>
			</table>
			<div class="actions">
				<?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'profiles', 'action' => 'edit', $user['Profile']['id']), array('escape' => false, 'class' => 'btn btn-default')); ?>
			</div>
		</div><!-- end col md 12 -->
	</div>
	