<div class="form loginRegForm">

	<div class="formTag167">Регистрация</div>

	<?php $form=$this->beginWidget('CActiveForm', 
	array(
		'id'=>'register-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<?php echo $form->errorSummary($model); ?>
		
		<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('size'=>'30','maxlength'=>'40','autocomplete'=>'on')); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>

		<div class="row">
		<?php echo $form->labelEx($model,'password2'); ?>
		<?php echo $form->passwordField($model,'password2', array('size'=>'30','maxlength'=>'40','autocomplete'=>'on')); ?>
		<?php echo $form->error($model,'password2'); ?>
		</div>
		
		<div class="row buttons loginRegButton">
		<?php
		echo CHtml::submitButton('Change');
		?>
		</div>
	
	<?php $this->endWidget(); ?>

</div><!-- form -->
