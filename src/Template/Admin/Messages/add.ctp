
<!-- -------------------------------- FORM -------------------------------- -->
<div class="box">
    <div class="box-header">


    </div>
    <div class="box-body">
        <?= $this->Html->link(__('<button type="button" class="btn btn-success">Lista</button>'), ['action' => 'index'], ['escape' => false]) ?>

        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Üzenet témák</button>'), ['controller' => 'Messagethemes', 'action' => 'index'], ['escape' => false]) ?>
        <?= $this->Html->link(__('<button type="button" class="btn btn-primary">Új üzenet téma</button>'), ['controller' => 'Messagethemes', 'action' => 'add'], ['escape' => false]) ?>
    </div>
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <div class="box-header">
        </div>

        <div class="col-sm-2">
            &nbsp;
        </div>
        <div class="col-sm-10">
            <h3 class="box-title"><?= __('Új felvitele') ?></h3>
        </div>
    </div>
    <?= $this->Form->create($message,['class'=>'form-horizontal']) ?>
        <div class="box-body">
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Téma:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('messagetheme_id', ['options' => $messagethemes, 'label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false] ); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Neve:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', ['label'=>false, 'class'=>'form-control', 'autofocus'=>true, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Telefon:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Tárgy:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('subject', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Szöveg:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('body', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Olvasva:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('readed', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Olvasva:</label>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('readedtime', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div>            
            <!--div class="form-group">
                <label for="group_id" class="col-sm-2 control-label">Ki olvasta:</label>
                <div class="col-sm-10">
                    <?php //echo $this->Form->input('whoisreaded', ['label'=>false, 'class'=>'form-control', 'autofocus'=>false, 'disabled'=>false]); ?>
                </div>
            </div-->
        </div><!-- /.box-body -->

        <div class="box-footer">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <?= $this->Form->button('<i class="fa fa-fw fa-save"></i> Mentés',['class'=>'btn btn-success']) ?>
                <a style="margin-left: 10px;" class="btn btn-default" href="<?php if($admin){echo "/admin";}?>/messages/index"><i class="fa fa-fw fa-close"></i> Mégsem</a>
            </div>
        </div><!-- /.box-footer -->

    <?= $this->Form->end() ?>
</div>
<!-- -------------------------------- /FORM -------------------------------- -->
