<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<p class="small"><?php echo lang('bf_required_note'); ?></p>

<?php if (isset($user) && $user->role_name == 'Banned') : ?>
<div class="notification attention">
	<p><?php echo lang('us_banned_admin_note'); ?></p>
</div>
<?php endif; ?>

<?php echo form_open($this->uri->uri_string(), 'class="constrained ajax-form"'); ?>

	<div>
		<label><?php echo lang('us_first_name'); ?></label>
		<input type="text" name="first_name" value="<?php echo isset($user) ? $user->first_name : set_value('first_name') ?>" />
	</div>

	<div>
		<label><?php echo lang('us_last_name'); ?></label>
		<input type="text" name="last_name" value="<?php echo isset($user) ? $user->last_name : set_value('last_name') ?>" />
	</div>
	
	<div>
		<label class="required"><?php echo lang('bf_email'); ?></label>
		<input type="text" name="email" class="medium" value="<?php echo isset($user) ? $user->email : set_value('email') ?>" />
	</div>
	
	<br />
	
	<div>
		<label class="required"><?php echo lang('bf_password'); ?></label>
		<input type="password" name="password" value="" />
	</div>
	<div>
		<label class="required"><?php echo lang('bf_password_confirm'); ?></label>
		<input type="password" name="pass_confirm" value="" />
	</div>
	
	<fieldset>
		<legend><?php echo lang('us_role'); ?></legend>
		
		<div>
			<label><?php echo lang('us_role'); ?></label>
			<select name="role_id">
			<?php if (isset($roles) && is_array($roles) && count($roles)) : ?>
				<?php foreach ($roles as $role) : ?>
				<option value="<?php echo $role->role_id ?>" <?php echo isset($user) && $user->role_id == $role->role_id ? 'selected="selected"' : '' ?> <?php echo !isset($user) && $role->default == 1 ? 'selected="selected"' : ''; ?>>
					<?php echo $role->role_name ?>
				</option>
				<?php endforeach; ?>
			<?php endif; ?>
			</select>
		</div>
	</fieldset>
	
	<fieldset>
		<legend><?php echo lang('us_address'); ?></legend>
		
		<div>
			<label><?php echo lang('us_street_1'); ?></label>
			<input type="text" name="street_1" class="medium" value="<?php echo isset($user) ? $user->street_1 : set_value('street_1') ?>" />
		</div>
		<div>
			<label><?php echo lang('us_street_2'); ?></label>
			<input type="text" name="street_2" class="medium" value="<?php echo isset($user) ? $user->street_2 : set_value('street_2') ?>" />
		</div>
		<div>
			<label><?php echo lang('us_city'); ?></label>
			<input type="text" name="city" value="<?php echo isset($user) ? $user->city : set_value('city') ?>" />
		</div>
		<div>
			<label><?php echo lang('us_country') ?></label>
			<?php echo country_select(isset($user) && !empty($user->country_iso) ? $user->country_iso : 'US', 'US'); ?>
		</div>
		<div>
			<label><?php echo lang('us_state'); ?></label>
			<?php echo state_select(isset($user) ? $user->state_id : 0, 'MO'); ?>
		</div>
		<div>
			<label><?php echo lang('us_zipcode'); ?></label>
			<input type="text" name="zipcode" size="7" maxlength="7" style="width: 6em; display: inline;" value="<?php echo isset($user) ? $user->zipcode : set_value('zipcode', ' ') ?>"  /> 
		</div>

	</fieldset>
	
	<div class="submits">
		<input type="submit" name="submit" value="Save User" /> or <?php echo anchor('admin/settings/users', 'Cancel'); ?>
	</div>

	<?php if (isset($user)) : ?>
	<div class="box delete rounded">
		<a class="button" id="delete-me" href="<?php echo site_url('admin/settings/users/delete/'. $user->id); ?>" onclick="return confirm('<?php echo lang('us_delete_account_confirm'); ?>')"><?php echo lang('us_delete_account'); ?></a>
		
		<?php echo lang('us_delete_account_note'); ?>
	</div>
	<?php endif; ?>

<?php echo form_close(); ?>