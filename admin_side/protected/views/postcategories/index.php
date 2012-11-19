<?php
$this->breadcrumbs=array(
	'Postcategories',
);

$this->menu=array(
	array('label'=>'Create Postcategories', 'url'=>array('create')),
	array('label'=>'Manage Postcategories', 'url'=>array('admin')),
);
?>

<h1>Postcategories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
