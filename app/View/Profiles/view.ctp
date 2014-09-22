<div class="profiles view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Profile'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Profile'), array('action' => 'edit', $profile['Profile']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Profile'), array('action' => 'delete', $profile['Profile']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Profiles'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Profile'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<?php if(!empty($profile['Profile']['id'])): ?>
<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($profile['Profile']['id']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['user_id'])): ?>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($profile['User']['id'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['full_name'])): ?>
<tr>
		<th><?php echo __('Full Name'); ?></th>
		<td>
			<?php echo h($profile['Profile']['full_name']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['picture'])): ?>
<tr>
		<th><?php echo __('Picture'); ?></th>
		<td>
			<img src="<?php echo $this->webroot.'img/'.$profile['Profile']['picture']; ?>" class="img-responsive">
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['thumbnail_picture'])): ?>
<tr>
		<th><?php echo __('Thumbnail Picture'); ?></th>
		<td>
			<img src="<?php echo $this->webroot.'img/'.$profile['Profile']['thumbnail_picture']; ?>" class="img-responsive">
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['bio'])): ?>
<tr>
		<th><?php echo __('Bio'); ?></th>
		<td>
			<?php echo h($profile['Profile']['bio']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['created'])): ?>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($profile['Profile']['created']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($profile['Profile']['modified'])): ?>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($profile['Profile']['modified']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

