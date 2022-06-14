
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($postimage,['class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) ?>
        <div class="box-body">
            <!-- Multiple file upload -->
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Kép file</label>
                <div class="col-sm-9">
                    <?= $this->Form->input('uploadfiles', ['type'=>'file', 'multiple'=>'multiple', 'name' => 'files[]', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
            </div>
<?php /*
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Title:</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('title', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Body:</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('body', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Filename:</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('filename', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="current" class="col-sm-2 control-label">Aktuális:</label>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('current', ['label'=>false, 'class'=>'form-control', 'checked'=>true ]); ?>
                </div>
            </div>            
*/ ?>

        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/postimages/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
