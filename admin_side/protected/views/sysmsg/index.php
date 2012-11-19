<?php
$this->breadcrumbs=array(
	'Sysmsgs',
);

$this->menu=array(
	array('label'=>'Create Sysmsg', 'url'=>array('create')),
	array('label'=>'Manage Sysmsg', 'url'=>array('admin')),
);
?>

<h1>Sysmsgs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
