<div class="settings">
	<div class="panel panel-default interests">
		<div class="panel-heading">
			Interests
		</div>
		<div class="panel-body">
			<?php if (!empty($interests)): ?>
				<form>
					<?php foreach ($interests as $interest): ?>
						<input type="checkbox" name="interests[]" value="<?php echo $interest->id ?>"><?php echo $interest->name ?>
					<?php endforeach; ?>
				</form>
			<?php endif; ?>
		</div>
	</div>
</div>