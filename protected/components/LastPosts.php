<?php

Yii::import('zii.widgets.CPortlet');

class LastPosts extends CPortlet
{
	public $title='';
	public $maxPosts=10;

	public function getLastPosts()
	{
		return Post::model()->findLastPosts($this->maxPosts);
	}

	protected function renderContent()
	{
		$this->render('lastPosts');
	}
}
