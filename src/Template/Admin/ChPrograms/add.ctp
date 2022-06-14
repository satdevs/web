
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
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
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($program,['class'=>'form-horizontal']) ?>
        <div class="box-body">
<?php /*
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Csomagok:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('ch_packages._ids', ['options' => $ch_packages, 'style'=>'height: 400px;' ]); ?>
                    <?php //echo $this->Form->input('ch_packages._ids', ['options'=>$ch_packages, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true, 'multiple'=>'multiple', 'style'=>'height: 400px;' ]); ?>
                </div>
            </div>
*/ ?>        
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Tulajdonos:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('owner_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Jelleg:</label>
                <div class="col-sm-4">
                    <?php //echo $this->Form->input('feature_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                    <?php echo $this->Form->input('feature_id', ['label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>"true", 'data-actions-box'=>"true", 'autofocus'=>false, 'disabled'=>false]); ?>

                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Nyelv:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('language', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Neve:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">URL:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('url', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Logo URL:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('logo_url', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Műsor cím:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('programs_url', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Email:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cím:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('address', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Telefon:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Megjegyzés:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('comment', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'height: 120px;' ]); ?>
                </div>
            </div>

       
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/ch_programs/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
