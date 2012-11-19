<?php
$this->breadcrumbs=array(
	'Hscategories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hscategory', 'url'=>array('index')),
	array('label'=>'Manage Hscategory', 'url'=>array('admin')),
);
?>

<!--portlet block-->
	<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">
<div class='span-11'><b>Create New Category</b></div>
<div align="right"><?php echo CHtml::link('^', array('#') ); ?></div>
</div>
</div>

<div class="portlet-content">
<div align="justify">	

	 <?php echo $this->renderPartial('_form', array('model'=>$model, 'data'=>$data,)); ?>

<hr>
</div>
</div>
</div>
<!--portlet block end-->


