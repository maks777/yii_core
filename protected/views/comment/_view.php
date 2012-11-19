<div class="comment" id="c<?php echo $data->id; ?>">

	<?php echo CHtml::link("#{$data->id}", $data->url, array(
		'class'=>'cid',
		'title'=>'Permalink to this comment',
	)); ?>

	<div class="author">
		<?php echo $data->authorLink; ?> says on
		<?php echo CHtml::link(CHtml::encode($data->post->title), $data->post->url); ?>
	</div>

	<div class="time">
		<?php if($data->status==Comment::STATUS_PENDING): ?>
			<span class="pending">Pending approval</span> |
			<?php echo CHtml::linkButton('Approve', array(
				'submit'=>array('comment/approve','id'=>$data->id),
			)); ?> |
		<?php endif; ?>
		<?php echo CHtml::link('Update',array('comment/update','id'=>$data->id)); ?> |
		<?php echo CHtml::linkButton('Delete', array(
			'submit'=>array('comment/delete','id'=>$data->id),
			'confirm'=>"Are you sure to delete comment #{$data->id}?",
		)); ?> |
		<?php echo date('F j, Y \a\t h:i a',$data->create_time); ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($data->content)); ?>
	</div>

</div><!-- comment -->


			<?php /*
			<div  style="float:none;">
             <figure>
                <img class="img-radius" src="/images/images.jpg" alt="Lorem ipsum"/>
                
                <figcaption>Title: Lorem ipsum</figcaption>
            </figure>
            </div>
            <p>  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui ulpa qui officia deserunt mollit anim id est laborum.</p> 

		*/	?>
		<?php /*
            <section>
                <div id="clear"></div>
                <h3 id="coment">Leave a coment</h3>
                <div class="text-coment">
                <table border="0">
                     <tbody>
                        <tr>
                            <td> 
                    <div id="pic">
                        <img id="ava"  src="/images/site/ava.jpg" alt="Lorem ipsum"/>
            
            </div>
                            </td>
                            <td> <p class="time-section"><a href="#"> Lexey</a> September 5, 2012</p>
                    «Если я опубликовал запись в Фейсбуке, то об этом надо написать в Твиттер» — фейсбук и твиттер сами это уме</td>
                        </tr>
                    </tbody>
                </table>
</div>
                            </section>

			*/ ?>
