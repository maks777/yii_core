<?php
$this->breadcrumbs=array(
	'Postcategories'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Postcategories', 'url'=>array('index')),
	array('label'=>'Create Postcategories', 'url'=>array('create')),
	array('label'=>'Update Postcategories', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Postcategories', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Postcategories', 'url'=>array('admin')),
);
?>

<h1>View Postcategories #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'title',
		'parent_category',
		'description',
		'create_date',
		'valid',
		'tooltip',
		'position',
		'url',
	),
)); ?>
