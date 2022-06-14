
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Vissaz a feltöltések listájához</button>'), ['action' => 'index'], ['escape' => false]) ?>

    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="col-sm-1">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Módosítás') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($upload,['class'=>'form-horizontal']); ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szolg.csoport:</label>
                <div class="col-sm-5">
                    <?php echo $this->Form->input('servicegroup', [
                        'options'=> $servicegroups,
                        'type'=>'select',
                        'label'=>false, 'class'=>'form-control selectpicker', 'autofocus'=>false, 'disabled'=>false ]);
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="visible" class="col-sm-1 control-label">Hatályos:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('current', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
			
            <div class="form-group">
                <label for="name" class="col-sm-1 control-label">Címe:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            

            <div class="form-group">
                <label for="pos" class="col-sm-1 control-label">Megjelenés -tól:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('date_from', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false, 'minYear'=>date('Y')-10, 'maxYear'=>date('Y')+5,]); ?>					
                </div>
            </div>

            <div class="form-group">
                <label for='show_in_mainpage' class="col-sm-1 control-label">Látszik az oldalon:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('show_in_mainpage', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>
			
            <div class="form-group">
                <label for="pos" class="col-sm-1 control-label">Poz.:</label>
                <div class="col-sm-2">
                    <?php echo $this->Form->input('pos', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false]); ?>
                </div>
            </div>            
			
            <div class="form-group">
                <label for="visible" class="col-sm-1 control-label">Látható:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('visible', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="text" class="col-sm-1 control-label">Leírás:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('text', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            

        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/uploads/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
