<?php
$this->breadcrumbs=array(
	'Sysmsgs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Sysmsg', 'url'=>array('index')),
	array('label'=>'Create Sysmsg', 'url'=>array('create')),
	array('label'=>'Update Sysmsg', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Sysmsg', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sysmsg', 'url'=>array('admin')),
);
?>

<h1>View Sysmsg #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'body',
		'user_id',
		'create_date',
		'type',
	),
)); ?>
