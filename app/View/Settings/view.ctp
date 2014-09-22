<div class="settings view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Setting'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Setting'), array('action' => 'edit', $setting['Setting']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Setting'), array('action' => 'delete', $setting['Setting']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $setting['Setting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Settings'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Setting'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<?php if(!empty($setting['Setting']['id'])): ?>
<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($setting['Setting']['id']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($setting['Setting']['name'])): ?>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($setting['Setting']['name']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($setting['Setting']['value'])): ?>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($setting['Setting']['value']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($setting['Setting']['created'])): ?>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($setting['Setting']['created']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($setting['Setting']['modified'])): ?>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($setting['Setting']['modified']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

