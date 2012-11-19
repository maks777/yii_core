<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'urlname'); ?>
		<?php echo $form->textField($model,'urlname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'urlname'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php
		
	//	echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50));
		
		$this->widget('ext.editMe.ExtEditMe', array(
    	'model'=>$model,
    	'attribute'=>'content',
		'resizeMode'=>'vertical',
		'toolbar'=>array(
			array('Source'), 
			array('Undo', 'Redo'),
			array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord'), 
			array('RemoveFormat'),
			array('Find', 'Replace'),
			array('Table', 'HorizontalRule', 'SpecialChar'), 
			array('Maximize', 'ShowBlocks'),
			array(
          'Image', 'Flash', 'Iframe'),
			'/',
			array('Font', 'FontSize'), 
			array('Bold', 'Italic', 'Underline'), 
			array('JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
			array('NumberedList', 'BulletedList', '-', 'Subscript', 'Superscript', '-', 'Outdent', 'Indent'),
			array('TextColor', 'BGColor'), 
			),
		'height'=>'400px',
		'advancedTabs'=>'false',
		));
	
		?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',Lookup::items('PageStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent'); ?>
		<?php echo $form->dropDownList($model,'parent',Page::getPropList(Page::getParentList(0,0), 'This is root page')); ?>
		<?php echo $form->error($model,'parent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_title'); ?>
		<?php echo $form->textField($model,'meta_title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_description'); ?>
		<?php echo $form->textField($model,'meta_description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'meta_keys'); ?>
		<?php echo $form->textField($model,'meta_keys',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'meta_keys'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
