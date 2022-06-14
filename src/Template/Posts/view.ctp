        <div class="col-sm-8 col-sm-pull-4">
            <div class="blog">

                <div class="blog-item">
                    <img class="img-responsive img-blog" src="<?php
                        if(file_exists(WWW_ROOT.'images'.DS.'uploads'.DS.'posts'.DS.$post->id.'_post.jpg')){
                            echo '/images/uploads/posts/'.$post->id.'_post.jpg';    
                        }else{
                            echo '/images/uploads/postcategories/'.$post->postcategory_id.'_big.jpg';
                        }
                    ?>" width="100%" alt="" />
                    <div class="blog-content">
                        <h3><?= $post->title //$this->Text->highlight($post->title, $searchtext,['format' => '<span class="highlight">\1</span>']); ?></h3>
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
                        <?= $post->short_text ?>
                        <?= $post->body ?>

                    </div>
                </div><!--/.blog-item-->
                <img src="/images/shadow.png" style="height: 20px; width:100%; margin-bottom: 20px;" />

     		</div><!--/.row-->

            <h2 class="text-center" style="margin-top: 0px;">
                <a href="/hirek.html" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Összes hírek... </a>
            </h2>
            
     	</div>


<?php /*



<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $post->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $post->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Adatlap megtekintése') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($post,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">User Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('user_id', ['options' => $users, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
                </div>
            </div>            

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cím:</label>
                <div class="col-sm-10">
                    <div class="form-control">
                        <?php echo $post->title; ?>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <div style="border: 1px solid lightgray; padding: 10px;">
                        <?php echo $post->body; ?>
                    </div>
                </div>
            </div>            

        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/posts/edit/<?= $post->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/posts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
*/ ?>
