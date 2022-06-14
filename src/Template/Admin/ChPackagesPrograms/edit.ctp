
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Form->postLink(
                __('<button type="button" class="btn btn-danger">Töröl</button>'),
                ['action' => 'delete', $packagesProgram->id],
                ['escape' => false, 'confirm' => __('Valóban törölni szeretnéd: #{0}?', $packagesProgram->id)]
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
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($packagesProgram,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">RANG:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('packageorder', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Csomag:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('package_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Műsor:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('program_id', ['label'=>false, 'class'=>'form-control selectpicker', 'data-live-search'=>"true", 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Terjesztés:</label>
                <div class="col-sm-3">
                    <?php echo $this->Form->input('broadcast', ['id'=>'PackagesProgramBroadcast', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">LCN:</label>
                <div class="col-sm-1">
                    <?php echo $this->Form->input('lcn', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'style'=>'text-align: center;' ]); ?>
                </div>
            </div>            

<!-- /ANALÓG -->
            <div class="form-group analog">
                <label for="group_id" class="col-sm-1 control-label">Band:</label>
                <div class="col-sm-1">
                    <?php echo $this->Form->input('band_id', ['label'=>false, 'class'=>'form-control selectpicker analog', 'data-live-search'=>"true", 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
<!-- /ANALÓG -->

<!-- DIGITÁLIS -->
            <div class="form-group digitalis">
                <label for="group_id" class="col-sm-1 control-label">QAM:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('qam', ['label'=>false, 'class'=>'form-control digitalis', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group digitalis">
                <label for="group_id" class="col-sm-1 control-label">SID:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('sid', ['label'=>false, 'class'=>'form-control digitalis', 'autofocus'=>false, 'disabled'=>false, 'style'=>'text-align: center;' ]); ?>
                </div>
            </div>            
<!-- /DIGITÁLIS -->


            <!--div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Channel:</label>
                <div class="col-sm-10">
                    <?php //echo $this->Form->input('channel', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Neve:</label>
                <div class="col-sm-4">
                    <?php //echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div-->            

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Nyilv.tartalom:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('public_comment', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Megjegyzés:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('comment', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/ch_packages_programs/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
