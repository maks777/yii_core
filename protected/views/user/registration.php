<?php
$this->pageTitle=Yii::app()->name . ' - Регистрация пользователя';
Yii::app()->clientScript->registerMetaTag('Регистрация на сервиса BESTOFFER.ua! Экономьте свое время и получайте лучшие предложения на товары и услуги с помощью сервиса BESTOFFER.ua!', 'description'); 
Yii::app()->clientScript->registerMetaTag('лучшие цены, лучшая цена, лучшие предложения, бест, best offer, лучшее предложение, бест оффер', 'keywords'); 
?>

<?php if(Yii::app()->user->hasFlash('register')): ?>

	<div class="form loginRegForm" style="padding:20px;width:420px;">
	<table height="100px">
		<tr><td width="80px">
			<img src="/css/img/bo_logo70x70.png" alt="BESTOFFER Logo"/>
		</td><td width="340px">
			<?php echo Yii::app()->user->getFlash('register'); ?>
		</td></tr>
	</table>
	<div class="registerEnterTag">
		<?php echo CHtml::link('Вход', '/site/login', array('class'=>'btnForm','style'=>'color:#ffffff')); ?>
	</div>
	</div>

<?/*
<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('register'); ?>
</div>*/?>

<?php else: ?>
	
	
<div class="form loginRegForm">

	<div class="formTag167">Регистрация</div>

	<?php $form=$this->beginWidget('CActiveForm', 
	array(
		'id'=>'register-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>false,
		),
	)); ?>

		<?php echo $form->errorSummary($model); ?>
		
		<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('size'=>'30','maxlength'=>'30','autocomplete'=>'on')); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
		
		<?php echo $form->hiddenField($model,'salt',array('value'=>'immortalvita')); ?>

		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<?php $this->widget('CCaptcha', array('clickableImage'=>true, 'showRefreshButton'=>true, 'buttonLabel' => CHtml::image(Yii::app()->baseUrl. '/css/refresh.png'),'imageOptions'=>array('style'=>'/*display:block;*/border:none;cursor:pointer;', 'alt'=>'Картинка с кодом валидации', 'title'=>'Чтобы обновить картинку, нажмите по ней'))); ?><p></p>
                    
		<?php echo $form->textField($model,'verifyCode', array ('size'=>'15','autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>

		</div>
		<?php endif; ?>

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
		
		<script language="javascript" type="text/javascript">
			
			$(document).ready(function(){
				var checkBox = document.getElementById('User_rules');
				if ( checkBox.checked == true) {
					submitProtect();  
					}
				});

				function submitProtect() {
					var submit = document.getElementById('submit');
					if ( submit.disabled == true ) {
						submit.disabled = false;
					}else{
						submit.disabled = 'disabled';
					}
				}

		</script>

		<div class="row" style="margin-bottom:0px;">
		<?
			echo $form->labelEx($model,'rules'); 
			echo $form->checkBox($model,'rules', array('onclick'=>"submitProtect();")); 
			echo $form->error($model,'rules'); 
		?>
		<?php 
			echo CHtml::link('Site rules', '/site/rules', array('id'=>'rules','target'=>'_blank', 'style'=>'margin-left:50px;'));
		?>
		</div>
		<div class="row buttons loginRegButton">
		<?php
		echo CHtml::submitButton('Register' , array('id'=>'submit', 'disabled'=>"disabled"));
		?>
		</div>
	
	<?php $this->endWidget(); ?>

</div><!-- form -->
	
<?php endif; ?>




