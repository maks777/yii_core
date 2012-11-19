<?php
$this->breadcrumbs=array(
	'Sysmsgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Sysmsg', 'url'=>array('index')),
	array('label'=>'Manage Sysmsg', 'url'=>array('admin')),
);
?>

<h1>Create Sysmsg</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>