
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
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($post,['class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Kép<br>(750x400):</label>
                <div class="col-sm-9">
                    <img src="/images/uploads/posts/<?= $post->id ?>_thumb.jpg" style="height: 60px; margin-bottom: 8px;">
                    <a style="margin-left: 10px;" onclick='confirm("Valóban törölni szeretnéd a képet?")' class="btn btn-danger" href="<?php if($admin){echo "/admin";}?>/posts/deleteimage/<?= $post->id ?>"><i class="fa fa-fw fa-remove"></i> Kép törlése</a>
                    <?= $this->Form->input('uploadfiles', ['type'=>'file', 'name' => 'files[]', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Kép nélkül:</label>
                <div class="col-sm-9">
                    <?= $this->Form->input('no_img', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
            </div>
			
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Megjelenhet:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('visible', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Megj. kezdete:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('visible_start', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
                <div class="col-sm-3">
                    &larr; Megjelenés kezdete
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Megj. vége:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('visible_end', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
                <div class="col-sm-3">
                    &larr; Megjelenés vége
                </div>
            </div>
            <div class="form-group">
                <label for="date_from" class="col-sm-1 control-label">Publikálva:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('date_from', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
			
			
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Kategória</label>
                <div class="col-sm-3">
                    <?= $this->Form->input('postcategory_id', ['options' => $postcategories, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cím:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('title', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>
			
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Rövid szöveg:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('short_text', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('body', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            
<?php /*
            <div class="form-group">
                <label for="date_from" class="col-sm-1 control-label">Közzétéve:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('date_from', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
*/ ?>
			
            <!--div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Létrehozva:</label>
                <div class="col-sm-10">
                    <?php //echo $this->Form->input('created', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div-->
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/posts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
