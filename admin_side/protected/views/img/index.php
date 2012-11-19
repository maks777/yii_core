<?php
$this->breadcrumbs=array(
	'Imgs',
);

$this->menu=array(
	array('label'=>'Create Img', 'url'=>array('create')),
	array('label'=>'Manage Img', 'url'=>array('admin')),
);
?>

<h1>Imgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
