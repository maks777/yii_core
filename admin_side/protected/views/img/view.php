<?php
$this->breadcrumbs=array(
	'Imgs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Img', 'url'=>array('index')),
	array('label'=>'Create Img', 'url'=>array('create')),
	array('label'=>'Update Img', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Img', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Img', 'url'=>array('admin')),
);
?>

<h1>View Img #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'src',
		'tumb1',
		'tumb2',
		'user_id',
		'create_date',
		'status',
	),
)); ?>
