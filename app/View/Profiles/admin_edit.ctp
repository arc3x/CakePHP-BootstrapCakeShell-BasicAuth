<!--?php debug( $schema); ?-->

<div class="profiles form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Admin Edit Profile'); ?></h1>
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

							    <li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Profile.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Profile.id'))); ?></li>
							    <li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Profiles'), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Profile', array('role' => 'form', 'type' => 'file')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('full_name', array('class' => 'form-control', 'placeholder' => 'Full Name'));?>
				</div>
				<div class="form-group">

                                <?php if (isset($this->request->data['Profile']['picture'])): ?>
                                    <label for="picture_cover">Picture&nbsp;(<?php echo substr($this->request->data['Profile']['picture'],strrpos($this->request->data['Profile']['picture'], '/')+1); ?>)</label>
                                <?php else: ?>
                                    <label for="picture_cover">Picture&nbsp;()</label>
                                <?php endif; ?>
                                <input id="picture" type="file" name="data[Profile][upload][picture]" style="display:none">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="picture_browse" onclick="$('input[id=picture]').click();" class="btn btn-default" type="button"><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;Browse...</button>
                                        <button id="picture_clear" onclick="$(this).picture_clear();" class="btn btn-default" type="button" style="display: none;"><span style="top:2px;" class="glyphicon glyphicon-remove-sign"></span>&nbsp;&nbsp;Clear</button>
                                    </span>
                                    <input id="picture_cover" type="text" class="form-control" disabled="disabled">
                                </div>
                                <script type="text/javascript">
                                    $('input[id=picture]').change(function() {
                                        $('#picture_cover').val($(this).val());
                                        $('#picture_browse').hide();
                                        $('#picture_clear').show();
                                        $('#picture_clear').focus();
                                    });
                                (function( $ ){
                                    $.fn.picture_clear = function() {
                                        var input = $("#picture");
                                        input.replaceWith(input.val('').clone(true));
                                        $('#picture_cover').val("");
                                        $('#picture_browse').show();
                                        $('#picture_browse').focus();
                                        $('#picture_clear').hide();
                                        return this;
                                    };
                                })( jQuery );
                                </script>

                            				</div>
				<div class="form-group">
					<?php echo $this->Form->input('Profile.thumbnail_picture', array('type' => 'hidden', 'placeholder' => 'Thumbnail Picture'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bio', array('class' => 'form-control', 'placeholder' => 'Bio'));?>
				</div>
				<div class="form-group">
					<div class="submit">
						<?php echo $this->Form->submit(__('Submit'), array('name' => 'data[submit]', 'class' => 'btn btn-default', 'div' => false)); ?>
						<?php echo $this->Form->submit(__('Apply'), array('name' => 'data[apply]', 'class' => 'btn btn-default', 'div' => false, 'style' => 'margin-left:10px;')); ?>
					</div>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
