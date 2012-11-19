<ul>
	<?php foreach($this->getLastPosts() as $post): ?>
	<li>
		<?php echo CHtml::link(CHtml::encode($post->title), $post->getUrl()); ?>
	</li>
	<?php endforeach; ?>
</ul>
