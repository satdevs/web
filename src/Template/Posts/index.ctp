
        <div class="col-sm-8 col-sm-pull-4">
            <div class="blog">

<?php foreach ($posts as $post): ?> 
                <div class="blog-item">
<?php if($post->no_img == 0){ ?>
                    <img class="img-responsive img-blog" src="<?php
                        if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$post->id.'_post.jpg')){
                            echo '/images/uploads/posts/'.$post->id.'_post.jpg';    
                        }else{
                            echo '/images/uploads/postcategories/'.$post->postcategory_id.'_big.jpg';
                        }
                    ?>" width="100%" alt="" />
<?php } ?>
                    <div class="blog-content">
                        <h3><?= $post->title ?></h3>
                        <div class="entry-meta">
                            <!--span><i class="icon-user"></i> <a href="#"><?php //= $post->user_id ?></a></span-->
                            <!--span><i class="icon-folder-close"></i> <a href="#">Bootstrap</a></span-->
                            <span><?= $this->Time->format( $post->date_from, 'yyyy.MM.dd. HH:mm:ss', null, $post->time_zone ); ?></span>
                            <!--span><?php //= $post->postcategory->title ?></span-->
                            <span><?= $post->postcategory->title //$this->Text->highlight($post->postcategory->title, $searchtext,['format' => '<span class="highlight">\1</span>']); ?></span>
                            <!--span><i class="icon-comment"></i> <a href="blog-item.html#comments">3 Comments</a></span-->
                        </div>

                        <?php //= $post->body ?>
                        <?php //searchtext ?>
                        <?php //= $post->body //$this->Text->highlight($post->body, $searchtext, ['format' => '<span class="highlight">\1</span>']); ?>
                        <?= $post->short_text //$this->Text->highlight($post->body, $searchtext, ['format' => '<span class="highlight">\1</span>']); ?>
<?php if($post->body != ''){ ?>
						<h2 class="text-center" style="margin-top: 0px;">
							<a href="/posts/view/<?= $post->id ?>" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Olvass tovább... </a>
						</h2>
<?php } ?>
						
                    </div>
                </div><!--/.blog-item-->
                <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

<?php endforeach; ?> 
<?php if( $this->request->here != "/"){ //Ha nem a kezdőlapon van ?>
                <!--div style="border: 1px solid gray; padding: 0px; width: 100%;"-->
                    <?= $this->element('paginator') ?>
                <!--/div-->
<?php }else{ //Egy tovább gombot érdemes lenne ide tenni, vagy az összes hírekre való utalást ?>

<?php } ?>

     		</div><!--/.row-->

<?php if($this->request->params['pass'][0]=='home'){ ?>
            <h2 class="text-center" style="margin-top: 0px;">
                <a href="/hirek.html" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Összes hírek... </a>
            </h2>
<?php } ?>
            
     	</div>

