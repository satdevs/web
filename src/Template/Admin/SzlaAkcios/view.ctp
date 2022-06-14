
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $akcio->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $akcio->id)]
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
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Adatlap megtekintése') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($akcio,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Focikk:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('focikk', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cikk:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cikk', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Akcios Kedv:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('akcios_kedv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Duo Kedv:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('duo_kedv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Trio Kedv:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('trio_kedv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/akcios/edit/<?= $akcio->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/akcios/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
