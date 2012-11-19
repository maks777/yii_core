<?php
$this->breadcrumbs=array(
	'Imgs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Img', 'url'=>array('index')),
	array('label'=>'Create Img', 'url'=>array('create')),
	array('label'=>'View Img', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Img', 'url'=>array('admin')),
);
?>

<h1>Update Img <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>