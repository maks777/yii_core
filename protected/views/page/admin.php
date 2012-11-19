<?php
$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Pages</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
		array(
			'name'=>'user_id',
			'value'=>'User::getUserName($data->user_id)',
			'filter'=>false,
		),
		array(
			'name'=>'create_date',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'name'=>'update_date',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'name'=>'status',
			'value'=>'Lookup::item("PageStatus",$data->status)',
			'filter'=>Lookup::items('PageStatus'),
		),
		array(
			'name'=>'parent',
			'value'=>'Page::getPageTitle($data->parent)',
			'filter'=>Page::getPropList(Page::getParentList(0,0), 'This is root page'),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

