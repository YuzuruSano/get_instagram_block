<?php
defined("C5_EXECUTE") or die("Access Denied.");
$form = Core::make('helper/form');
?>
<div class="form-group">
	<?php  echo $form->label('instagramID', t("instagram ID")); ?>
	<?php  echo isset($btFieldsRequired) && in_array('instagramID', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
	<?php  echo $form->text('instagramID', $instagramID, array(),''); ?>
</div>

<div class="form-group">
	<?php  echo $form->label('token', t("アクセストークン")); ?>
	<?php  echo isset($btFieldsRequired) && in_array('token', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
	<?php  echo $form->text('token', $token, array(),''); ?>
</div>

<div class="form-group">
	<?php  echo $form->label('num', t("表示件数")); ?>
	<?php  echo $form->text('num', $num, array(),''); ?>
</div>