
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $productDepend->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $productDepend->id)]
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
    <?= $this->Form->create($productDepend,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tv:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tv', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Net:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('net', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tel:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/productDepends/edit/<?= $productDepend->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/szla_product_depends/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
