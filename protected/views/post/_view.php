<h1><?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?></h1>
             <p class="time-section">posted by <?php echo $data->author->username . ' on ' . date('F j, Y',$data->create_time); ?>
			 </p>
            <div class="content">
				<?php
					$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
					echo $data->content;
					$this->endWidget();
				?>
			</div> 
			<div class="nav">
				<b>Tags:</b>
				<?php echo implode(', ', $data->tagLinks); ?> |
				<?php echo CHtml::link('Permalink', $data->url); ?> |
				<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
				Last updated on <?php echo date('F j, Y',$data->update_time); ?>
			</div>

