<form method="POST" id="<?php echo !empty($form_id) ? $form_id : 'fyn-search-form'; ?>" class="fyn-form<?php echo !empty($form_class) ? ' ' . $form_class : ''; ?>">
	<div class="fyn-form-field">
		<input type="text" name="postcode" id="<?php echo !empty($field_id) ? $field_id : 'fyn-search-field'; ?>" class="fyn-form-input<?php echo !empty($field_class) ? ' ' . $field_class : ''; ?>"<?php echo !empty($field_placeholder) ? ' placeholder="'.$field_placeholder.'"' : ''; ?>>
	</div>
	<div class="fyn-form-submit">
		<button type="submit" class="fyn-form-button<?php echo !empty($button_class) ? ' ' . $button_class : ''; ?>"><?php echo !empty($button_text) ? $button_text : 'Search'; ?></button>
	</div>
</form>