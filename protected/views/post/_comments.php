<?php foreach($comments as $comment): ?>
	<div class="comment" id="c<?php echo $comment->id; ?>">
		<div class="text-coment">
						<table border="0">
							 <tbody>
								<tr>
									<td> 
							<div id="pic">
								<img id="ava"  src="/images/site/ava.jpg" alt="Lorem ipsum"/>
					
							</div>
									</td>
									<td>
									<p class="com_time_section"><?php echo $comment->authorLink; ?> 
									says: <?php echo date('F j, Y \a\t h:i a',$comment->create_time); ?>
									|
									<?php echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
											'class'=>'cid',
											'title'=>'Permalink to this comment',
									)); ?>
									</p>
										 <?php echo nl2br(CHtml::encode($comment->content)); ?>
									</td>
								</tr>
							</tbody>
						</table>
		</div>

	</div><!-- comment -->
<?php endforeach; ?>


