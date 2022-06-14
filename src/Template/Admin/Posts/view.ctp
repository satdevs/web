
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
                <label for="group_id" class="col-sm-1 control-label">Kép:</label>
                <div class="col-sm-9">
                    <img src="/images/uploads/posts/<?= $post->id ?>_thumb.jpg" style="height: 200px; margin-bottom: 8px;">
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">User Id:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('user_id', ['options' => $users, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Kategória</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('postcategory_id', ['options' => $postcategories, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
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
