<?php
$this->breadcrumbs=array(
	'Imgs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Img', 'url'=>array('index')),
	array('label'=>'Manage Img', 'url'=>array('admin')),
);
?>

<h1>Create Img</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>