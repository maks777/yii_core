<?php
$this->breadcrumbs=array(
	'Postcategories'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Postcategories', 'url'=>array('index')),
	array('label'=>'Create Postcategories', 'url'=>array('create')),
	array('label'=>'View Postcategories', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Postcategories', 'url'=>array('admin')),
);
?>

<h1>Update Postcategories <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>