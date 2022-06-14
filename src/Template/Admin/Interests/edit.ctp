
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $interest->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $interest->id)]
            )
        ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Interestdetails</button>'), ['controller' => 'Interestdetails', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új Interestdetail</button>'), ['controller' => 'Interestdetails', 'action' => 'add'], ['escape' => false]) ?>
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
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($interest,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cookie:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('cookie', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">City:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('city', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Address:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Phone:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Email:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Státusz:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('status', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Message:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('message', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/interests/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
