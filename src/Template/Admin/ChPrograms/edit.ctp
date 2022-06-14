
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">

<?php
/*
    //$sel = [];
    foreach($ch_packages as $p){
        echo $p.", ";
    //    $sel[] = $p->id;
    }
*/
?>

        </div>

        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($program,['class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) ?>
        <div class="box-body">

<?php
    //foreach ($ch_packages as $ch_package) {
        //debug( $ch_package );
    //}

    //debug($ch_packages);
/*

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Csomagok:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('ch_packages._ids', ['options' => $ch_packages, 'style'=>'height: 400px;']); ?>
                    <?php //echo $this->Form->input('ch_packages._ids', ['selected'=>$sel, 'options' => $ch_packages, 'style'=>'height: 400px;' ]); ?>
                    <?php //echo $this->Form->input('ch_packages._ids', ['options'=>$ch_packages, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true, 'multiple'=>'multiple', 'style'=>'height: 400px;' ]); ?>
                </div>
            </div>
*/
?>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Neve:</label>
                <div class="col-sm-4">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>true ]); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Logo file:</label>
                <div class="col-sm-3">
                    <?= $this->Form->input('uploadfiles', ['type'=>'file', 'name' => 'files', 'label'=>false, 'class'=>'form-control', 'autofocus'=>false]); ?>
                </div>
                <div class="col-sm-1">
					<?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                </div>
                <div class="col-sm-4">
					(250x250px)
                </div>
            </div>
			
<?php if(file_exists(WWW_ROOT."images".DS."logo".DS.$program->logo_file)){ ?>
            <div class="form-group">
                <label for="logo_file" class="col-sm-1 control-label">Logo:</label>
                <div class="col-sm-4">
					<img src="/images/logo/<?= $program->logo_file ?>" style="width: 100px;">
                </div>
<?php /*
                    <?php echo $this->Form->input('logo_file', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
*/ ?>
            </div>
			<hr>
<?php } ?>


<?php /*
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
*/ ?>
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

<?php /*			
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
*/ ?>
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
