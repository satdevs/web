
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-header">


    </div>
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $category->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $category->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Photos</button>'), ['controller' => 'Photos', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Photo</button>'), ['controller' => 'Photos', 'action' => 'add'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>

        <div class="col-sm-2">
            <?= $this->Html->link(__('<i class="fa fa-fw fa-close"></i> Mégsem'), ['controller' => 'Photos', 'action' => 'index'], ['escape' => false, 'style'=>'margin-left: 10px;', 'class'=>'btn btn-primary']) ?>
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Adatlap megtekintése') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($category,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>true]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Pos:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('pos', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/categories/edit/<?= $category->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/categories/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
