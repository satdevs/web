
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $interestdetail->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $interestdetail->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Interests</button>'), ['controller' => 'Interests', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Interest</button>'), ['controller' => 'Interests', 'action' => 'add'], ['escape' => false]) ?>
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
    <?= $this->Form->create($interestdetail,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Interest Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('interest_id', ['options' => $interests, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true] ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Productdesc Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('productdesc_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Product Id:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('product_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Price:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('price', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Product Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('product_name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Product Group:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('product_group', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <a class="btn btn-success" href="<?php if($admin){echo "/admin";}?>/interestdetails/edit/<?= $interestdetail->id ?>"><i class="fa fa-fw fa-edit"></i> Módosít</a>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/interestdetails/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
