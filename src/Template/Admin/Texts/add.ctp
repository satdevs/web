
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-header">


    </div>
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($text,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Cím:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('title', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                </div>
            </div>            

<div style="padding: 10px; border: 1px solid red; width: 90%; margin-bottom: 10px;">
            <h3>Ha a szöveg valamelyik szolgáltatásokhoz tartozik, akkor melyik után jelenjen meg?</h3>
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Fejállomás:</label>
                <div class="col-sm-5">
                    <?php //echo $this->Form->input('headstation_id', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false ]); ?>
                    <?php echo $this->Form->input('headstation_id', [
                        'options'=> [
                            0=>'--- Normál szöveg esetén nincs kiválasztva ---',
                            1=>'1. Bóly',
                            2=>'2. Felsőszentiván',
                            3=>'3. Udvar',
                            4=>'4. Homorúd',
                            5=>'5. Újmohács',
                        ],
                        'type'=>'select',
                        'label'=>false, 'class'=>'form-control selectpicker', 'autofocus'=>false, 'disabled'=>false ]);
                    ?>

                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Csoport:</label>
                <div class="col-sm-5">
                    <?php echo $this->Form->input('servicegroup', [
                        'options'=> $servicegroups,
                        'type'=>'select',
                        'label'=>false, 'class'=>'form-control selectpicker', 'autofocus'=>false, 'disabled'=>false ]);
                    ?>
                </div>
            </div>            
</div>

            <div class="form-group">
                <label for="group_id" class="col-sm-1 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('text', ['label'=>false, 'class'=>'form-control tinymce', 'autofocus'=>false, 'disabled'=>false ]); ?>
                </div>
            </div>            
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/texts/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
