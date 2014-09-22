<div class="tokens view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Token'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Token'), array('action' => 'edit', $token['Token']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Token'), array('action' => 'delete', $token['Token']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $token['Token']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Tokens'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Token'), array('action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<?php if(!empty($token['Token']['id'])): ?>
<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($token['Token']['id']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($token['Token']['type'])): ?>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($token['Token']['type']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($token['Token']['role'])): ?>
<tr>
		<th><?php echo __('Role'); ?></th>
		<td>
			<?php echo h($token['Token']['role']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($token['Token']['token'])): ?>
<tr>
		<th><?php echo __('Token'); ?></th>
		<td>
			<?php echo h($token['Token']['token']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($token['Token']['created'])): ?>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($token['Token']['created']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
<?php if(!empty($token['Token']['modified'])): ?>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($token['Token']['modified']); ?>
			&nbsp;
		</td>
</tr>
<?php endif; ?>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

