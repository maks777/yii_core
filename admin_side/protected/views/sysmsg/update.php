<?php
$this->breadcrumbs=array(
	'Sysmsgs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sysmsg', 'url'=>array('index')),
	array('label'=>'Create Sysmsg', 'url'=>array('create')),
	array('label'=>'View Sysmsg', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Sysmsg', 'url'=>array('admin')),
);
?>

<h1>Update Sysmsg <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>