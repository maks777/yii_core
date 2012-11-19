<!DOCTYPE html>
<html>
 <head>
    <meta charset="UTF-8" />
    <meta name="language" content="en" />
    <meta name="keywords" content="" />
    <meta name="author" content="Greeschenko Alexey" />
    <meta name="description" content="" />
            <!--[if lt IE 9]>
                    <script>
                     var e = ("article,aside,figcaption,figure,footer,header,hgroup,nav,section,time").split(',');
                     for (var i = 0; i < e.length; i++) {
                       document.createElement(e[i]);
                     }
                    </script>
            <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/site.css"  />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
     <title><?php echo CHtml::encode($this->pageTitle); ?></title>
 </head>
 <body>
     <header>
         <p id="header-logo"><a class="none" href="/" >ItsumLiberumGroup</a></p>
     </header>
        <nav>
            <div id="mainmenu">
                <?php
                $this->widget('ext.CDropDownMenu.CDropDownMenu',array(
			'style' => 'default', // or default or navbar or vertical
			'items'=>Menu::getMenuDecodeArrey(1)));
		
                    ?>
            </div>
        </nav>
     <article>
         <aside>
             <div id="breadcrumbs">
				<?php $this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$this->breadcrumbs,
				)); ?><!-- breadcrumbs -->
             </div>
        </aside>
         <section>
			<?php Sysmsg::ViewSysMsgs();?>
			<?php echo $content; ?>


		 <?/*
             <h1>A Test Post</h1>
             <p class="time-section">posted by Lexey on September 5, 2012</p>
            <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
            <div  style="float:none;">
             <figure>
                <img class="img-radius" src="/images/images.jpg" alt="Lorem ipsum"/>
                
                <figcaption>Title: Lorem ipsum</figcaption>
            </figure>
            </div>
            <p>  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui ulpa qui officia deserunt mollit anim id est laborum.</p> 
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
         </section>
         
     </article>
     <aside>
         <div id="sitebar-right">
			<?php 
				if(!Yii::app()->user->isGuest) 
				{
					echo '<h3 id="sitebar">User Menu</h3>';
					$this->widget('UserMenu'); 		
				}
			?>
			
			<h3 id="sitebar">Last post</h3> 
            <?php $this->widget('LastPosts', array(
				'maxPosts'=>Yii::app()->params['lastPostsCount'],
			)); ?>


			<h3 id="sitebar">Recent Comments</h3> 
			<?php $this->widget('RecentComments', array(
				'maxComments'=>Yii::app()->params['recentCommentCount'],
			)); ?>

            <h3 id="sitebar">Tag cloud</h3>
			<?php $this->widget('TagCloud', array(
				'maxTags'=>Yii::app()->params['tagCloudCount'],
			)); ?>
			 
         </div>
         
     </aside>
     <div id="clear"></div>
     <footer>
         <aside>
             <div id="footer-smoll">
                <ul id="post-list">
                 <li><a href="#">How Edit My Profile...</li>
                 <li><a href="#">How Create Post</li>
                 <li><a href="#">Create Comments</li>
                 <li><a href="#">Test post #1</li>
                 <li><a href="#">Test post #2</li>
                 <li><a href="#">Test post #3</li>
                 <li><a href="#">Test post #</a></li>
             </ul> 
             </div>
             <div id="footer-center">
                 <div class="soc">
                     <a href="#"><img   src="/images/site/g.png" alt="Google +"/></a>
                     <a href="#"><img   src="/images/site/fb.png" alt="Facebook"/></a>
                     <a href="#"><img   src="/images/site/tw.png" alt="Twitter"/></a>
                     <a href="#"><img   src="/images/site/vk.png" alt="Vcontakte"/></a>
                     <a href="#"><img   src="/images/site/rss.png" alt="RSS"/></a>
                     <a href="#"><img   src="/images/site/sk.png" alt="Skype"/></a>
                 </div>
                 <address><p id="copy">Copyright &copy; <?php echo date('Y'); ?> IustumLiberumGroup. All Rights Reserved. <a href="mailto:greeschenko@gmail.com?subject=«ItsumLiberumGroup»">greeschenko@gmail.com</a></p></address>
             </div>
             <div id="footer-smoll">
                <ul id="post-list">
                 <li><a href="#">How Edit My Profile...</li>
                 <li><a href="#">How Create Post</li>
                 <li><a href="#">Create Comments</li>
                 <li><a href="#">Test post #1</li>
                 <li><a href="#">Test post #2</li>
                 <li><a href="#">Test post #3</li>
                 <li><a href="#">Test post #</a></li>
             </ul> 
             </div>
             
         </aside>
         
     </footer>
 </body>
</html>
